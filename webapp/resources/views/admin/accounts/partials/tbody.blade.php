@foreach($accounts as $account)
    <tr class="hover:bg-slate-50/50 transition">
        <td class="p-5 text-center">
            <input type="checkbox" class="w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-blue-500">
        </td>
        <td class="p-5">
            <div class="flex items-center gap-3">
                <!-- Dynamic Initials Avatar representing mock avatar -->
                @php
                    $words = explode(' ', $account->full_name);
                    $initials = '';
                    foreach ($words as $w) {
                        $initials .= substr($w, 0, 1);
                        if(strlen($initials) >= 2) break;
                    }
                    $initials = strtoupper($initials);
                    
                    // Dynamic premium colors based on character name to match aesthetic variety
                    $colors = [
                        'A' => 'bg-indigo-500', 'B' => 'bg-sky-500', 'C' => 'bg-emerald-500',
                        'D' => 'bg-teal-500', 'E' => 'bg-cyan-500', 'F' => 'bg-violet-500',
                        'G' => 'bg-purple-500', 'H' => 'bg-pink-500', 'I' => 'bg-rose-500',
                        'J' => 'bg-blue-600', 'K' => 'bg-amber-500', 'L' => 'bg-orange-500',
                        'M' => 'bg-red-500', 'N' => 'bg-emerald-600', 'O' => 'bg-indigo-600',
                        'P' => 'bg-violet-600', 'Q' => 'bg-purple-600', 'R' => 'bg-pink-600',
                        'S' => 'bg-rose-600', 'T' => 'bg-sky-600', 'U' => 'bg-teal-600',
                        'V' => 'bg-cyan-600', 'W' => 'bg-amber-600', 'X' => 'bg-orange-600',
                        'Y' => 'bg-red-600', 'Z' => 'bg-blue-500'
                    ];
                    $firstLetter = substr($initials, 0, 1);
                    $bgColor = $colors[$firstLetter] ?? 'bg-indigo-500';
                @endphp
                <div class="w-10 h-10 rounded-full {{ $bgColor }} flex items-center justify-center font-bold text-white shadow-sm">
                    {{ $initials }}
                </div>
                <span class="font-semibold text-slate-800 text-sm">{{ $account->full_name }}</span>
            </div>
        </td>
        <td class="p-5 text-sm text-slate-600">{{ $account->email }}</td>
        <td class="p-5 text-sm">
            @if(strtoupper($account->role) === 'ADMIN')
                <span class="inline-flex items-center px-3 py-1 text-xs font-semibold text-[#D97706] bg-[#FEF3C7] border border-[#D97706] rounded-lg uppercase tracking-wide">
                    Admin
                </span>
            @else
                <span class="inline-flex items-center px-3 py-1 text-xs font-semibold text-blue-600 bg-[#E0E7FF] border border-blue-600 rounded-lg uppercase tracking-wide">
                    Operator
                </span>
            @endif
        </td>
        <td class="p-5 text-center">
            <div class="flex items-center justify-center gap-3">
                <!-- Edit Action -->
                <a href="{{ route('accounts.edit', $account) }}" class="text-slate-500 hover:text-[#2F27CE] p-1.5 rounded-lg hover:bg-slate-100 transition duration-200" title="Edit">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                </a>
                <!-- Delete Action -->
                <form method="POST" action="{{ route('accounts.destroy', $account) }}" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun {{ $account->full_name }}?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-slate-500 hover:text-red-600 p-1.5 rounded-lg hover:bg-slate-100 transition duration-200 cursor-pointer" title="Hapus">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </form>
            </div>
        </td>
    </tr>
@endforeach
