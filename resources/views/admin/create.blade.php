<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hi, <span style="color: #3490dc;">{{ Auth::user()->name }}</span>
        </h2>
    </x-slot>
    <div class="container" style="max-width: 400px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px; margin-top: 20px;">
        <h1 style="text-align: center; margin-bottom: 20px; font-size: 24px;">Create Category</h1>
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="category_name" style="font-weight: bold;">Category Name</label>
                <input type="text" id="category_name" name="category_name" class="form-control" style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ddd;">
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 10px; border-radius: 5px; background-color: #3490dc; color: #fff; border: none; cursor: pointer;">Create Category</button>
        </form>
    </div>
</x-app-layout>
