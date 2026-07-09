@props([
    'id' => 'all-trash',
    'name' => 'Total Semua',
    'image_name' => 'all_trash.png',
    'total' => 0
])

<div
    class="bg-white rounded-2xl shadow-[0_4px_20px_rgba(0,0,0,0.09)] border border-slate-100 p-6
    hover:-translate-y-1 hover:shadow-[0_8px_30px_rgba(0,0,0,0.09)] transition-all duration-300"
>
    <h3 class="text-center font-bold text-slate-700 mb-4 text-lg tracking-tight">{{ $name }}</h3>
    <img
        src="{{ asset('images/kategori/' . $image_name) }}"
        class="w-full h-36 object-cover rounded-xl mb-5 shadow-sm"
        alt="Plastik">
    <p
        id="{{ $id }}"
        class="text-center font-extrabold text-4xl text-slate-800 trash-count"
        data-base="{{ $total }}"
        data-default="{{ $total }}"
    >{{ $total }}</p>
</div>
