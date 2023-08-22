@extends('layout')

@section('content')

    <div class="bg-white p-6 rounded-md shadow">
        <h2 class="text-xl font-semibold mb-4">Upload New Banner</h2>
        <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block font-medium mb-2" for="image">Image:</label>
                <input type="file" class="w-full p-2 border rounded-md" id="image" name="image" accept="image/*">
            </div>
            <img id="image-preview" class="w-16 h-auto mb-2" src="">

            <div class="mb-4">
                <label class="block font-medium mb-2" for="url">URL:</label>
                <div class="flex items-center">
                    <span class="mr-2">image/</span>
                    <input type="text" class="w-full p-2 border rounded-md" id="url" name="url">
                </div>
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-2">Target Type:</label>
                <div>
                    <input type="radio" id="target_type_same_window" name="target_type" value="same_window">
                    <label for="target_type_same_window" class="mr-2">Same Window</label>

                    <input type="radio" id="target_type_new_window" name="target_type" value="new_window">
                    <label for="target_type_new_window">New Window</label>
                </div>
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-2">Position:</label>
                <div>
                    <input type="radio" id="position_slider" name="position" value="1">
                    <label for="position_slider" class="mr-2">1 - Slider</label>

                    <input type="radio" id="position_sidebar" name="position" value="2">
                    <label for="position_sidebar" class="mr-2">2 - Sidebar</label>

                    <input type="radio" id="position_footer_left" name="position" value="3">
                    <label for="position_footer_left" class="mr-2">3 - Footer Left</label>

                    <input type="radio" id="position_footer_middle" name="position" value="4">
                    <label for="position_footer_middle" class="mr-2">4 - Footer Middle</label>

                    <input type="radio" id="position_footer_right" name="position" value="5">
                    <label for="position_footer_right">5 - Footer Right</label>
                </div>
            </div>

            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Upload</button>
        </form>
    </div>

    <div class="bg-white p-6 rounded-md shadow">
        <h2 class="text-xl font-semibold mb-4">Existing Banners</h2>
        @foreach ($bannersByPosition as $position => $banners)
            <div class="mb-4 border-2 border-gray-300 rounded-lg p-4">
                <h3 class="text-lg font-semibold mb-2">Position {{ $position }} - {{ $positionTitles[$position] }}</h3>
                <ul>
                    @foreach ($banners as $banner)
                        <li class="flex flex-row justify-between items-center">
                            <div class="flex items center mb-2">
                                <a href="{{ route('banners.show', ['url' => $banner->url]) }}">
                                    <img class="h-auto mr-2 w-32" src="{{ asset('storage/' . $banner->image_path) }}" alt="Banner Image">
                                </a>
                                <div>
                                    <p><span class="font-bold">URL</span>: /image/{{ $banner->url }}</p>
                                    <p><span class="font-bold">Target type</span>: {{ $banner->target_type }}</p>
                                    <p><span class="font-bold">Views</span>: {{ $banner->views_count }}</p>
                                    <p><span class="font-bold">Clicks</span>: {{ $banner->clicks_count }}</p>
                                </div>
                            </div>
                            <form
                                method="POST"
                                action="{{ route('banners.destroy', ['banner' => $banner->id]) }}"
                                class="inline-block"
                                onsubmit="return confirm('Are you sure you want to delete this banner?')"
                            >
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">Delete</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
@endsection
