<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Danh sách bài viết') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
<h2>Danh sách bài viết</h2>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
                    @if(session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tiêu đề</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hành động</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($articles as $a)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $a->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $a->title }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $routePrefix = Request::is('admin/*') ? 'admin.articles.' : 'articles.';
                                    @endphp
                                    <a href="{{ route($routePrefix . 'show', $a->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Xem</a>
                                    @can('update', $a)
                                        <a href="{{ route($routePrefix . 'edit', $a->id) }}" class="text-green-600 hover:text-green-900 mr-3">Sửa</a>
                                    @endcan
                                    @can('delete', $a)
                                        <form action="{{ route($routePrefix . 'destroy', $a->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-gray-500">Chưa có bài viết nào.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>