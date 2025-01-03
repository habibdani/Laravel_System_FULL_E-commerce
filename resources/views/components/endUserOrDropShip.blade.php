<section name="consult" class="py-0 mt-[140px]">
    <div class="flex flex-col items-center justify-center mx-auto w-full h-full">
        <span class=" leading-[26px] mb-[40px] text-[22px] text-[#292929] font-bold items-center justify-center font-medium">Pilih Sebelum Berbelanja</span>
        <div class="flex items-center justify-center w-[994px] space-x-[30px]">
            <!-- Left Section -->
            <div class="shadow-custom border-[1px] border-[#D9D9D9] w-[365px] h-[228px] p-4 flex items-center rounded-md space-x-[70px]">
                <div class="ml-[10px]">
                    <img src="{{ asset('storage/icons/end-user.svg') }}" alt="end-user" class="h-[46px] w-[50px] mb-3">
                    <span class="font-roboto text-[18px] font-normal mb-3 border-b border-[#E01535]">Exclusive Products for Personal Use</span>
                    <p class="font-roboto text-[12px] text-[#6B6B6B] mb-3">Discover premium products tailored for your personal needs. Shop now to enjoy exceptional quality and realible service.</p>
                    <form action="{{ url('/view-maps') }}" method="GET" class="inline">
                        @csrf
                        <input type="hidden" name="client_type_id" value="1">
                        <button type="submit" class="flex items-center justify-center w-[83px] h-[28.5px] inline-block bg-[#E01535] font-roboto text-[14px] font-semibold text-white rounded">Shop Now</button>
                    </form>
                </div>
            </div>
            <!-- Right Section -->
            <div class="shadow-custom border-[1px] border-[#D9D9D9] w-[365px] h-[228px] p-4 flex items-center rounded-md space-x-[70px]">
                <div class="ml-[10px]">
                    <img src="{{ asset('storage/icons/drop-ship.svg') }}" alt="drop-ship" class="h-[33px] w-[40px] mt-1 mb-3">
                    <span class="font-roboto text-[18px] font-normal mb-3 border-b border-[#E01535]">Streamlined Solutions for Drop Shippers</span>
                    <p class="font-roboto text-[12px] text-[#6B6B6B] mb-3">Boost your sales with our high-quality products at wholesale prices. Enjoy easy ordering and fast delivery direcytly to your customer</p>
                    <form action="{{ url('/view-maps') }}" method="GET" class="inline">
                        @csrf
                        <input type="hidden" name="client_type_id" value="2">
                        <button type="submit" class="flex items-center justify-center w-[83px] h-[28.5px] inline-block bg-[#E01535] font-roboto text-[14px] font-semibold text-white rounded">Shop Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .shadow-custom {
        box-shadow: 0px 4px 4px 0px #00000026;
    }
</style>

