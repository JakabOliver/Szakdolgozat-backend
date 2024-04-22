<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ET1ABV szakdolgozat - Invite admin
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 my-2">
                    <section class="flex flex-col">
                        <form action="{{route('user.store')}}" method="post">
                            @csrf
                            @method('POST')
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <div class="bg-red-100 border border-red-400 text-red-700 px-5 py-3 rounded relative" role="alert">
                                        <strong class="font-bold">Error!</strong>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            <div class="mt-3 grid grid-cols-4 gap-x-6 gap-y-8">
                                <div class="">
                                    <label for="name"
                                           class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                                    <div class="mt-2">
                                        <input type="text" name="name" id="name" value="{{old('name')}}"
                                               class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>
                                <div class="">
                                    <label for="email"
                                           class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                                    <div class="mt-2">
                                        <input type="text" name="email" id="email"  value="{{old('email')}}"
                                               class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>
                                <div class="">
                                    <label for="password"
                                           class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                                    <div class="mt-2">
                                        <input type="password" name="password" id="password"
                                               class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>
                                <div class="">
                                    <label for="password_confirmation"
                                           class="block text-sm font-medium leading-6 text-gray-900">Password again</label>
                                    <div class="mt-2">
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                               class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>
                                <div>
                                    <button class="border border-gray-300 bg-white hover:bg-gray-100 text-gray-700 font-semibold py-2 px-4 rounded" type="submit">Create</button>
                                </div>
                            </div>

                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
