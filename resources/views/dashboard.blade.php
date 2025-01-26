<x-app-layout>
    <x-slot name="header">
        <!-- Link naar CSS en JS-bestanden -->
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="{{ asset('js/Test.js') }}"></script>
        <script src="{{ asset('js/saveorder.js') }}"></script>
        <script src="{{ asset('js/dashboard.js') }}"></script>

        <!-- Dashboard Titel -->
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <div class="Title">
            <h1>Sushi Spot</h1>
        </div>
    </x-slot>

    <!-- Achtergrond en Flex-container -->
    <div class="back-background">
        <div class="flex-container">
            <div class="containerdash">
                <!-- Sushi Menu -->
                <div class="sushimenu">
                    <div class="buttons">
                        @foreach ($rootCategories as $category)
                            <a href="?category_id={{ $category->category_id }}"
                               class="button-33" role="button"
                               onclick="showContent('{{ $category->category_name }}')">
                               {{ $category->category_name }}
                            </a>
                        @endforeach
                    </div>

                    <!-- Categorieën -->
                    <div id="sushirollsContent" style="display:none;">
                        <main>
                            <section class="cards">
                                @foreach ($products as $product)
                                    <a href="#" class="card-link"
                                       onclick="handleClick('{{ $product->product_name }}', '{{ $product->price }}')">
                                        <div class="card">
                                            <div class="card__image-container">
                                                <img src="/imgs/{{ $product->image_url }}" />
                                            </div>
                                            <div class="card__content">
                                                <p class="card__title text--medium">{{ $product->product_name }}</p>
                                                <div class="card__info">
                                                    <p class="card__price text--medium">{{ $product->price }} Euro</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </section>
                        </main>
                    </div>

                    <div id="pokebowlsContent" style="display:none;">
                        <h1>Pokebowls</h1>
                    </div>

                    <div id="sushiboxenContent" style="display:none;">
                        <h1>Sushiboxen</h1>
                    </div>

                    <div id="snacksContent" style="display:none;">
                        <h1>Snacks</h1>
                    </div>

                    <div id="drankjesContent" style="display:none;">
                        <h1>Drankjes</h1>
                    </div>

                    <div id="warmedrankjesContent" style="display:none;">
                        <h1>Hotdrankjes</h1>
                    </div>

                    <div id="extraContent" style="display:none;">
                        <h1>Extra Content</h1>
                    </div>
                </div>


                <!-- Kassa sectie -->
                <div class="Kassa">
                    <div id="white-block">
                        <h1>Calculator</h1>
                        <div id="white-background">
                            <!-- Bekijk Bestellingen knop - Kassa -->
                            <button id="ordersButton">Bekijk Bestellingen</button>
                        </div>
                    </div>
                </div>

                <!-- Pop-up voor Bestellingen -->
                <<div id="orderPopup" class="popup">
                    <div id="orderList"></div>
                    <button id="closePopup">Sluiten</button>
                </div>

                </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
