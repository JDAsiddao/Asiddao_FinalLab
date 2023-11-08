<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Hi, <span style="color: #3490dc;">{{ Auth::user()->name }}</span>
        <b style = "float:right"> Total Categories: 
        <span class="badge text-white bg-danger">{{count($categories)}}</span></b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            
                <div><table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">User ID</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                         @foreach($categories as $category)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap">{{ $category->id }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap">{{ $category->category_name }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap">{{ $category->user_id }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap">{{ $category->created_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach 
                    </tbody>
                </table></div>
            </div>
        </div>
    </div>
</x-app-layout>