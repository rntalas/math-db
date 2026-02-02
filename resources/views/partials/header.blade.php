<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    @vite('resources/js/app.js')
</head>

<body>
    <header class="flex justify-between items-center px-8 py-4 bg-zinc-100">
        <div class="flex justify-center items-center gap-5 lg:gap-12">
            <div class="h-8 w-8 cursor-pointer">
                @svg('heroicon-o-bars-3')
            </div>

            <a href="/">
                <img src="{{ asset('images/logo.png') }}" alt="logo" class="h-5 md:h-10 lg:h-15 w-auto">
            </a>

            <a href="/" class="btn">Lessons</a>
        </div>

        <div class="flex justify-center items-center gap-4 lg:mr-20">
            <input type="text" placeholder="Search..."
                class="hidden md:block md:w-64 lg:w-96 xl:w-120 border rounded-full px-4 py-2" name="lesson">

            <div class="w-10 h-10 rounded-full p-2 border bg-white cursor-pointer hover:shadow-md">
                @svg('heroicon-o-magnifying-glass')
            </div>
        </div>
    </header>
