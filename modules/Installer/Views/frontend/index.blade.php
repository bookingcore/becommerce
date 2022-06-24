@extends('Layout::installer')
@section('content')
    <div class="mt-7 mb-3">
        <div class="max-w-4xl mx-auto text-center py-6">
            <h1 class="text-3xl font-bold text-gray-700">Becommerce Installer</h1>
        </div>
    </div>
    <div class="max-w-4xl mx-auto">
        <form action="{{route('installer.save_db')}}" method="POST">
            @csrf
            <div class="shadow sm:rounded-md sm:overflow-hidden">
                <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                    <p class="mt-1 text-sm text-gray-600">
                        Please enter your database connection details. For now, we only support MySql
                    </p>
                    <div class="grid grid-cols-3 gap-6">
                        <div class="col-span-3 sm:col-span-2 ">
                            <label for="DB_DATABASE" class="block text-sm font-medium text-gray-700">
                                Database Name
                            </label>
                            <div class="mt-1">
                                <input required type="text" name="DB_DATABASE" id="DB_DATABASE" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>
                        <div class="col-span-3 sm:col-span-2">
                            <label for="DB_USERNAME" class="block text-sm font-medium text-gray-700">
                                Username
                            </label>
                            <div class="mt-1">
                                <input type="text" name="DB_USERNAME" id="DB_USERNAME" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>
                        <div class="col-span-3 sm:col-span-2">
                            <label for="DB_PASSWORD" class="block text-sm font-medium text-gray-700">
                                Password
                            </label>
                            <div class="mt-1">
                                <input required type="text" name="DB_PASSWORD" id="DB_PASSWORD" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>
                        <div class="col-span-3 sm:col-span-2">
                            <label for="DB_HOST" class="block text-sm font-medium text-gray-700">
                                Database Host
                            </label>
                            <div class="mt-1">
                                <input required type="text" name="DB_HOST" id="DB_HOST" value="localhost" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 sm:px-6">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
