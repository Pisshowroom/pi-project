import{d as f,a as p,B as m,r as t,ae as _,af as h,l as b,o as k,b as g,f as B,g as w,e as D,S as a}from"./main.1261aef2.js";import{_ as v}from"./Table.vue_vue_type_style_index_0_lang.d5ea8be1.js";import"./vue3-datatable.d5793967.js";import"./transition.6e43a6c5.js";import"./dom.524a689c.js";import"./micro-task.49b87587.js";import"./open-closed.1e573750.js";const y=D("div",{style:{height:"70vh"}},null,-1),M=f({__name:"AdsIndex",setup(x){const s=p(),o=m("axios");t({}),t("Harian");const n=t(null);t("Harian"),_.users(),h({title:"Master Data Iklan"});const l=t([{field:"number",title:"No",slot:!0,sort:!1},{field:"page",title:"Halaman",cellRenderer:e=>e.page=="home"?"Beranda":e.page=="detail_product"?"Detail Produk":e.page=="all_product"?"Semua Produk":"Beranda",sort:!1},{field:"section",title:"Letak iklan",cellRenderer:e=>e.section=="under_recently_viewed_items"?"Di bawah Item yang baru dilihat":e.section=="above_best_selling_products"?"Diatas Produk Terlaris":e.section=="below_best_selling_products"?"Dibawah Produk Terlaris":e.section=="above_recommended_products"?"Diatas Produk yang direkomendasikan":e.section=="under_discount_products"?"Dibawah Produk Diskon":e.section=="side_slider"?"Samping Slider":e.section=="right_end_slider"?"Paling ujung dari Slider":e.section=="above_list_product"?"Diatas List Produk":e.section=="below_list_seller"?"Dibawah list penjual":"Beranda",sort:!1},{field:"actions",title:"Aksi",slot:!0,sort:!1}])||[],u=t([{type:"editIcon",to:({value:e})=>`/admin/ads/edit/${e.id}`},{type:"deleteIcon",click:({value:e})=>{const r=a.mixin({customClass:{popup:"sweet-alerts",confirmButton:"btn btn-danger",cancelButton:"btn btn-dark ltr:mr-3 rtl:ml-3"},buttonsStyling:!1}),c=a.mixin({toast:!0,position:"bottom-right",showConfirmButton:!1,customClass:{popup:"color-success"},timer:2e3,showCloseButton:!0});r.fire({title:"Hapus data?",text:"Apakah kamu yakin untuk menghapus data ini",icon:"warning",showCancelButton:!0,confirmButtonText:"Hapus",cancelButtonText:"Batal",reverseButtons:!0,padding:"2em"}).then(i=>{i.value?o.delete(`/admin/ads/${e.id}`).then(S=>{c.fire("Data berhasil dihapus."),n.value.getData()}):(i.dismiss,a.DismissReason.cancel)})}}]);t({}),t([]);const d=async()=>{s.isShowMainLoader=!0,s.isShowMainLoader=!1};return b(async()=>{await d()}),(e,r)=>(k(),g("div",null,[B(v,{url:"/admin/ads",cols:w(l),title:"Daftar Iklan",searching:!0,actions:u.value,ref_key:"datatable",ref:n,addRoute:"/admin/ads/form",addName:"Tambah"},null,8,["cols","actions"]),y]))}});export{M as default};
