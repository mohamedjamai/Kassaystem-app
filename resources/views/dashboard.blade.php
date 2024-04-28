<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="./css/dashboard.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <script src="{{ asset('js/dashboard.js') }}"></script>

        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <div class="Title">
            <h1> Sushi Spot <h1>
        </div>

    </x-slot>

<div class="back-background">
  <div class="flex-container">
    <div class="containerdash">
        <div class="sushimenu">
            <div class="buttons">
                @foreach ($rootCategories as $category)
                 <!-- <button class="button-33" role="button" onclick="showContent('{{ $category->category_name }}')">{{ $category->category_name }}</button> -->
                <a href="?category_id={{ $category->category_id }}" class="button-33" role="button" onclick="showContent('{{ $category->category_name }}')">{{ $category->category_name }}</a>
                <!-- <button class="button-33" role="button" onclick="window.location='/dd'">{{ $category->category_name }}</button> -->

             @endforeach
            </div>
             <div id="sushirollsContent" style="display:none;">
                <!-- Inhoud voor Sushi Roll's categorie -->

                    <main>
                        <section class="cards">
                          @foreach ($products as $product)
                          <a href="#" class="card-link" onclick="handleClick('{{ $product->product_name }}', '{{ $product->price }}')">


                          <div class="card">
                            <div class="card__image-container">
                              <img
                                src="/imgs/{{ $product-> image_url }}"
                              />
                            </div>
                            <div class="card__content">
                              <p class="card__title text--medium">
                                {{ $product->product_name }}
                              </p>
                              <div class="card__info">
                                <p class="card__price text--medium"> {{ $product->price }} Euro</p>
                              </div>
                            </div>
                          </div>

   @endforeach

</div>

            <!-- Laatste div -->    </div>
             <div id="pokebowlsContent" style="display: block;">
                    <!-- Inhoud voor Sushi Roll's categorie -->

                  <h1> Pokebowls </h1>


            <!-- Laatste div -->       </div>
         <div id="sushiboxenContent" style="display:none;">
                        <!-- Inhoud voor Sushi Roll's categorie -->
                        <h1> Sushiboxen </h1>



              <!-- Laatste div -->      </div>

            <div id="snacksContent" style="display:none;">
                            <!-- Inhoud voor Sushi Roll's categorie -->
                            <h1> Snacks </h1>




           <!-- Laatste div -->        </div>

           <div id="drankjesContent" style="display:none;">
                            <!-- Inhoud voor Sushi Roll's categorie -->
                            <h1> drankjes </h1>
            <!-- Laatste div -->        </div>

            <div id="warmedrankjesContent" style="display:none;">
                            <!-- Inhoud voor Sushi Roll's categorie -->
                            <h1> hotdrankjes </h1>




                            <!-- Laatste div -->        </div>

            <div id="extraContent" style="display:none;">
                                <!-- Inhoud voor Sushi Roll's categorie -->
                                <h1> Extra Content </h1>




                                <!-- Laatste div -->        </div>
            </div>

            <div class="Kassa">
            <div id="white-block">
              <h1>Calculator</h1>
              <div id="white-background">

                <p> </p>


              </div>
                </div>
                </div>
            </div>


</x-app-layout>
