<section name="why" class="py-0 mt-12">
    <div class="flex flex-col items-center justify-center mx-auto w-full h-full px-4">
        <div class="flex flex-col lg:flex-row items-center justify-center w-full lg:w-[994px] space-y-4 lg:space-y-0 lg:space-x-[30px]">
            <!-- Left Section -->
            <div class="shadow-custom w-full lg:max-w-[900px] h-full p-8 flex items-center justify-between rounded-md bg-white relative overflow-visible">
                <div class="flex-1 pr-6">
                    <h2 class="text-[22px] font-semibold mb-6 text-center lg:text-left">Why should you choose Andal Prima?</h2>
                    <div class="space-y-2">
                        <div class="flex items-start space-x-4 mb-2">
                            <img src="{{ asset('storage/icons/docs.svg') }}" alt="docs" class="w-auto h-[18.7px] mt-1">
                            <div>
                                <p class="font-semibold text-[16px] mb-1">Complete and accurate product information</p>
                                <p class="text-gray-600 text-[12px] leading-relaxed">
                                    We provide complete and accurate product information, including descriptions, specifications, and usage guides for every item we sell.
                                </p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4 mb-2">
                            <img src="{{ asset('storage/icons/stopwatch.svg') }}" alt="stopwatch" class="w-auto h-[20px] mt-1">
                            <div>
                                <p class="font-semibold text-[16px] mb-1">Delivery on time, according to schedule</p>
                                <p class="text-gray-600 text-[12px] leading-relaxed">
                                    Timely delivery according to the agreed schedule is our priority, ensuring your order arrives without delay.
                                </p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <img src="{{ asset('storage/icons/money.svg') }}" alt="money" class="w-auto h-[20px] mt-1">
                            <div>
                                <p class="font-semibold text-[16px] mb-1">Competitive prices and quality</p>
                                <p class="text-gray-600 text-[12px] leading-relaxed">
                                    We offer competitive prices with the best quality, so you get maximum value for every purchase.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Section -->
            <div class="shadow-custom w-full lg:max-w-[245px] h-full p-8 flex flex-col items-center justify-between rounded-md bg-white relative overflow-visible">
                <div class="absolute left-[-135px] z-10 lg:block">
                    <img src="{{ asset('storage/design/person.svg') }}" alt="person" class="z-1">
                </div>
                <div class="flex flex-col justify-center items-start h-full space-y-4">
                    <p class="text-[18px] font-semibold mb-2 w-[106px] text-start">We’re <br> the solution for exclusive products</p>

                    <!-- Customer Reviews Section -->
                    <div class="flex items-start space-x-4">
                        <img src="{{ asset('storage/icons/star.svg') }}" alt="star">
                        <div>
                            <p class="font-semibold text-[16px]">4.8/5</p>
                            <p class="text-gray-600 text-[12px] leading-relaxed">
                                Customer reviews
                            </p>
                        </div>
                    </div>

                    <!-- Total Products Sold Section -->
                    <div class="flex items-start space-x-4">
                        <img src="{{ asset('storage/icons/box.svg') }}" alt="box">
                        <div>
                            <p class="font-semibold text-[16px]">512,046 +</p>
                            <p class="text-gray-600 text-[12px] leading-relaxed">
                                Total Products Sell
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .shadow-custom {
        box-shadow: 0px 4px 4px 0px #00000026;
    }

    /* Responsive styling */
    @media (max-width: 768px) {
        /* Stack Right Section below Left Section */
        .flex-col.lg\:flex-row {
            flex-direction: column;
        }

        /* Center align text for smaller screens */
        .text-center {
            text-align: center;
        }

        /* Adjust the width of left and right sections on smaller screens */
        .lg\:max-w-[900px] {
            max-width: 100%;
        }

        .lg\:max-w-[245px] {
            max-width: 100%;
        }

        /* Adjust person image position */
        .absolute.right-\[-65px\] {
            position: static;
            margin-top: 20px;
        }
    }
</style>
