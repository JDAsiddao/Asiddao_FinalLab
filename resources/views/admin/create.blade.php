<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hi, <span style="color: #3490dc;">{{ Auth::user()->name }}</span>
        </h2>
    </x-slot>
    <div class="container"
        style="max-width: 400px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px; margin-top: 20px;">
        <h1 style="text-align: center; margin-bottom: 20px; font-size: 24px;">{{ isset($category) ? 'Edit Category' :
            'Create Category' }}</h1>
        <form enctype="multipart/form-data"
            action="{{ isset($category) ? route('categories.update', ['id' => $category->id]) : route('categories.store') }}"
            method="POST">
            @csrf
            @if(isset($category))
            @method('PUT')
            @endif
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="category_name" style="font-weight: bold;">Category Name</label>
                <input type="text" id="category_name" name="category_name" class="form-control"
                    style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ddd;"
                    value="{{ isset($category) ? $category->category_name : '' }}">
            </div>
            <button type="submit" class="btn btn-primary"
                style="width: 100%; padding: 10px; border-radius: 5px; background-color: #3490dc; color: #fff; border: none; cursor: pointer;">{{
                isset($category) ? 'Update Category' : 'Create Category' }}</button>
            <br><br>
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="category_image" style="font-weight: bold;">Image</label>
                <input type="file" id="category_image" name="category_image" class="form-control" accept="image/*">

            </div>
        </form>

    </div>

</x-app-layout>