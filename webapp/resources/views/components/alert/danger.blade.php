@props(['pesan' => 'Ini pesan'])

<div id="alert-wrapper"
    class="flex items-center justify-between p-4 bg-[#FEE2E2] border border-[#FCA5A5] rounded-2xl w-full max-w-xl">
    <span class="text-[#991B1B] text-sm">
        {{ $pesan }}
    </span>

    <div class="flex items-center gap-3">
        <div class="h-5 w-px bg-[#FFBBBB]"></div>
        <button type="button" onclick="closeAlert()"
            class="cursor-pointer text-[#991B1B] hover:opacity-75 transition-opacity focus:outline-none">
            <x-lucide-x class="size-5 stroke-[2.5]" />
        </button>
    </div>
</div>