@extends('layouts.app')

@section('content')
    <div class="container p-4 mx-auto">
        <div class="grid grid-flow-dense auto-rows-[200px] grid-cols-2 gap-4 md:grid-cols-4 lg:grid-cols-6">

            @if ($photos->isEmpty())
                <div class="flex items-center justify-center h-64 text-center text-gray-500 col-span-full">
                    <h1 class="text-2xl font-bold">No photos available</h1>
                </div>
            @else
                @foreach ($photos as $photo)
                    @php
                        $classes = 'col-span-1 row-span-1';
                        if ($loop->iteration % 6 == 1) {
                            $classes = 'col-span-1 row-span-2';
                        } elseif ($loop->iteration % 6 == 2) {
                            $classes = 'col-span-2 row-span-1';
                        } elseif ($loop->iteration % 10 == 5) {
                            $classes = 'col-span-2 row-span-2';
                        }
                    @endphp
                    <div class="{{ $classes }} group relative overflow-hidden rounded-lg shadow-sm">
                        <a href="{{ asset('storage/' . $photo->image) }}" class="block w-full h-full glightbox"
                            data-gallery="gallery1" data-title="{{ $photo->title }}"
                            data-description="{{ $photo->description }}">
                            <img src="{{ asset('storage/' . $photo->image) }}" alt="{{ $photo->title }}"
                                class="object-cover w-full h-full transition-transform duration-500 ease-in-out group-hover:scale-110">
                            <div
                                class="absolute inset-0 transition-all duration-300 bg-black bg-opacity-0 group-hover:bg-opacity-20">
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const lightbox = GLightbox({
                selector: '.glightbox',
                touchNavigation: true,
                loop: true,
                autoplayVideos: true,
                zoomable: true
            });
        });
    </script>
@endsection
