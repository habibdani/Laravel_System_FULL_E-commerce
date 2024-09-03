{{-- resources\views\shop-page.blade.php --}}
@extends('layouts.app')

@section('title', 'Andal Prima')

@section('content')
    @component('components.header') @endcomponent
    @component('components.sidebar') @endcomponent
    @component('components.banner')@endcomponent
    @component('components.productExplore')@endcomponent
    @component('components.productSpecial')@endcomponent
    @component('components.product3')@endcomponent
    @component('components.productDetails')@endcomponent
    @component('components.productRelate')@endcomponent
    @component('components.why-choose-us') @endcomponent
    @component('components.consultation') @endcomponent
    @component('components.partners') @endcomponent
    @component('components.footer') @endcomponent

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            function showSlide(slideNumber) {
                document.querySelectorAll('[id^="slide-"]').forEach(slide => slide.classList.add('hidden'));
                document.getElementById('slide-' + slideNumber).classList.remove('hidden');

                document.querySelectorAll('[id^="btn-slide-"]').forEach(btn => {
                    btn.classList.remove('text-white', 'bg-[#E01535]');
                    btn.classList.add('text-[#9D9D9D]', 'bg-transparent');
                });

                document.getElementById('btn-slide-' + slideNumber).classList.add('text-white', 'bg-[#E01535]');
                document.getElementById('btn-slide-' + slideNumber).classList.remove('text-[#9D9D9D]', 'bg-transparent');
            }

            window.addEventListener('load', function() {
                showSlide(2);
                const sidebar = document.getElementById('sidebar');
                sidebar.classList.add('sidebar-hidden');
                sidebar.classList.remove('sidebar-visible');

                const toggleBtn = document.getElementById('toggle');
                toggleBtn.classList.add('toggle-hidden');
                toggleBtn.classList.remove('toggle-visible');

                const btnSlide2 = document.getElementById('btn-slide-2');
                btnSlide2.classList.add('text-white', 'bg-[#E01535]');
                btnSlide2.classList.remove('text-[#9D9D9D]', 'bg-transparent');

                const considebar = document.getElementById('container-sidebar')
                considebar.classList.add('z-0');
                considebar.classList.remove('z-20');

                const button2 = document.getElementById('btn-slide-2');
                button2.removeAttribute('disabled');

                const jumlahitem = document.getElementById('jumlahitem');
                jumlahitem.classList.remove('hidden');

                const toslide2andshop = document.getElementById('to-slide-2-and-shop');
                toslide2andshop.classList.add('hidden');

                const totalbayar = document.getElementById('totalbayar');
                totalbayar.classList.remove('hidden');
            });

            // Menambahkan event listener ke setiap product-card
            document.querySelectorAll('.product-card').forEach(productCard => {
                productCard.addEventListener('click', async () => {
                    const productVariantId = productCard.getAttribute('product-variant-id');
                    const productTypeId = productCard.getAttribute('product-type-id');
                    try {
                        const productDetails = await fetchDetailProduct(productVariantId);
                        const relateProducts = await fetchRelateProduct(productTypeId);

                        console.log('Product details:', productDetails);
                        console.log('Product relate:', relateProducts);

                        const detailSection = document.querySelector('section[name="detail-product"]');
                        detailSection.classList.remove('hidden');

                        const relateSection = document.querySelector('section[name="relate-product"]');
                        relateSection.classList.remove('hidden');

                        // Update content pada detail product section sesuai dengan data yang diambil
                        // Misalnya: detailSection.innerHTML = renderProductDetail(productDetails);

                    } catch (error) {
                        console.error('Error fetching product details:', error);
                    }
                });
            });
        });

    </script>
    <style>
        #buttom-sidebar{
            margin-bottom: 25%;
        }
    </style>
@endsection


