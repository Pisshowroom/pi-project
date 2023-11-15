<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\MasterAccount;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function products(Request $request)
    {
        $query = Product::with(['seller'])->withAvg('reviews', 'rating')
            ->withSum(['order_items as total_sell' => function ($query) {
                $query->whereHas('order', function ($query) {
                    $query->where('status', 'done');
                });
            }], 'quantity');

        $query->byNotVariant();
        $filtered = false;

        if ($request->filled('rating')) {
            // $query->having('reviews_avg_rating', '>=', $request->input('rating'));
            $query->orderByDesc('reviews_avg_rating');
            $filtered = true;
        }

        // if request filled promo
        if ($request->filled('promo')) {
            $query->whereNotNull('discount');
            $filtered = true;
        }

        if ($request->filled('latest')) {
            $query->latest();
            $filtered = true;
        }

        if ($request->filled('lowest_price')) {
            $query->orderBy('price');
            $filtered = true;
        }

        if ($request->filled('highest_price')) {
            $query->orderByDesc('price');
            $filtered = true;
        }

        if ($filtered == false) {
            $query->inRandomOrder();
        }

        $products = $query->paginate(15);
        return ProductResource::collection($products);
    }

    public function show(Product $product)
    {

        $product->load(['category', 'variants', 'seller.address']);

        $product->loadAvg('reviews', 'rating');
        $product->loadCount(['reviews']);
        // product loadCount or loadSum reviews on images(array) - for counting total images

        $product->loadSum(['order_items as total_sell' => function ($query) {
            $query->whereHas('order', function ($query) {
                $query->where('status', 'done');
            });
        }], 'quantity');


        $totalImages2 = DB::table('reviews')
            ->selectRaw('SUM(JSON_LENGTH(images)) as total_images')
            ->where('product_id', $product->id)
            ->first()
            ->total_images;

        $product->total_images = (int)$totalImages2;

        // return ResponseAPI($product);

        $data['product'] = new ProductResource($product);

        /* $data['total_sell'] = OrderItem::where('product_id', $product->id)->whereHas('order', function ($query) {
            $query->where('status', 'done');
        })->sum('quantity'); */

        $productIds = Product::where('seller_id', $product->seller_id)->pluck('id');
        $averageRating = Review::whereIn('product_id', $productIds)->avg('rating');

        $data['rating_seller'] = doubleVal($averageRating);

        $user = auth()->guard('api-client')->user();
        if ($user != null && $product->seller_id != null) {
            $buyerAddress = $user->addresses()->where('main', true)->first();
            $sellerAddress = $product->seller->addresses()->where('main', true)->first();
            if ($buyerAddress != null && $sellerAddress != null) {
                $data['delivery_service'] = lypsisCheckShippingPrice($buyerAddress->ro_subdistrict_id, $sellerAddress->ro_subdistrict_id, $product->weight);
            } else {
                $data['delivery_service'] = null;
            }
        }



        $relatedProductsByCategory = Product::where('category_id', $product->category_id)
            ->whereNot('id', $product->id)
            ->inRandomOrder()
            ->take(7)
            ->get();

        $data['related_products'] = ProductResource::collection($relatedProductsByCategory);

        $productsFromSameSeller = Product::where('seller_id', $product->seller_id)
            ->whereNot('id', $product->id)
            ->inRandomOrder()
            ->take(7)
            ->get();

        $data['products_from_same_seller'] = ProductResource::collection($productsFromSameSeller);


        return $data;
    }

    // create function sellerMyProducts
    public function sellerMyProducts()
    {
        $userAuthed = auth()->guard('api-client');
        $products = Product::where('seller_id', $userAuthed->id())->byNotVariant()->paginate(15);
        return ProductResource::collection($products);
    }

    // create storeOrUpdateProduct function
    public function storeOrUpdateProduct(Request $request)
    {
        $user = auth()->guard('api-client')->user();

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'category_id' => 'required',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'weight' => 'required|integer|min:1',
            'images' => 'required',
            'images.*.file' => 'required',
            'unit' => 'required|string|max:255',
            'description' => 'required|string',
            // '' => 'nullable|integer|min:1|max:100'
        ]);

        $images = [];
        $isCreate = false;

        if ($request->filled('id')) {
            $product = Product::find($request->id);
        } else {
            $product = new Product();
            $isCreate = true;
        }

        if (!empty($request->images)) {
            foreach ($request->images as $img) {
                if (isset($img) && is_uploaded_file($img)) {
                    $images[] = uploadFoto($img, 'uploads/products/' . $user->id);
                } else if (isset($img)) {
                    $images[] = $img;
                }
            }
        }

        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->seller_id = $user->id;
        $product->slug = Str::slug($request->name);
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->weight = $request->weight;
        $product->unit = $request->unit;
        $product->description = $request->description;
        $product->discount = $request->discount;
        $product->images = $images;
        $product->save();

        if ($isCreate) {
            return ResponseAPI("Product berhasil disimpan.");
        } else {
            return ResponseAPI("Product berhasil diperbarui.");
        }
    }
    public function destroy(Product $product)
    {
        $product->delete();
        return ResponseAPI('Product berhasil dihapus.');
    }
}
