<x-app-layout>

    <div class="container py-8">

        @foreach($categories as $category)

            <section class="mb-4">

                <div class="flex items-center space-x-4 mb-2">

                    <h1 class="text-lg uppercase font-semibold text-gray-700">{{ $category->name }}</h1>

                    <a href="{{ route('categories.show', $category) }}" class="text-orange-500 font-semibold hover:text-orange-400 hover:underline">Ver mas</a>

                </div>

                @livewire('category-products', ['category' => $category], key($category->id))

            </section>

        @endforeach

    </div>

    @push('script')

        <script>

            Livewire.on('glider', function(id){

                new Glider(document.querySelector('.glider-' + id), {
                    slidesToScroll: 1,
                    slidesToShow: 1,
                    draggable: true,
                    dots: '.glider-' + id + '~ .dots',
                    arrows: {
                        prev: '.glider-' + id + '~ .glider-prev',
                        next: '.glider-' + id + '~ .glider-next'
                    },
                    responsive: [
                        {
                            breakpoint: 640,
                            settings: {
                                slidesToScroll: 2.5,
                                slidesToShow: 2,
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToScroll: 3.5,
                                slidesToShow: 3,
                            }
                        },
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToScroll: 4.5,
                                slidesToShow: 4,
                            }
                        },
                        {
                            breakpoint: 1280,
                            settings: {
                                slidesToScroll: 5.5,
                                slidesToShow: 5,
                            }
                        }
                    ]
                });

            });

        </script>

    @endpush

</x-app-layout>
