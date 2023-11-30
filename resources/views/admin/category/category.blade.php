<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hi, <span style="color: #3490dc;">{{ Auth::user()->name }}</span>
            <b style="float:right"> Total Categories:
                <span class="badge text-white bg-danger">{{count($categories)}}</span></b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Active Categories
                    </h2>
                    <table class="table table-dark table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category</th>
                                <th>User ID</th>
                                <th>Image</th>
                                <th>Created At</th>
                                <th>Actions</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->category_name }}</td>
                                <td>{{ $category->user_id }}</td>
                                <td>
                                    @if($category->category_image)
                                    <img src="{{ asset('storage/' . $category->category_image) }}" alt="Category Image"
                                        style="max-width: 100px;">
                                    @else
                                    No Image
                                    @endif
                                </td>
                                <td>{{ $category->created_at->diffForHumans() }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    <a href="{{ route('categories.edit', ['id' => $category->id]) }}"
                                        class="text-blue-500 hover:underline">Update</a>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    <form action="{{ route('categories.destroy', ['id' => $category->id]) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this category?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Soft-Deleted Categories
                    </h2>
                    <table class="table table-dark table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category</th>
                                <th>User ID</th>
                                <th>Image</th>
                                <th>Deleted At</th>
                                <th>Actions</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($softDeletedCategories as $softDeletedCategory)
                            <tr>
                                <td>{{ $softDeletedCategory->id }}</td>
                                <td>{{ $softDeletedCategory->category_name }}</td>
                                <td>{{ $softDeletedCategory->user_id }}</td>
                                <td>
                                    @if($softDeletedCategory->category_image)
                                    <img src="{{ asset('storage/' . $softDeletedCategory->category_image) }}"
                                        alt="Category Image" style="max-width: 100px;">
                                    @else
                                    No Image
                                    @endif
                                </td>
                                <td>{{ $softDeletedCategory->deleted_at->diffForHumans() }}</td>
                                <td>
                                    <form action="{{ route('categories.restore', ['id' => $softDeletedCategory->id]) }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit" class="text-green-500 hover:underline">Restore</button>
                                    </form>
                                </td>
                                <td>
                                    <form
                                        action="{{ route('categories.forceDelete', ['id' => $softDeletedCategory->id]) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to permanently delete this category?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline">Force Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>