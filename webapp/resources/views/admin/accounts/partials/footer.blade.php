<!-- Left: Showing results count -->
<div class="text-sm text-slate-500 font-medium">
    Show 
    <select id="per-page-select" class="bg-slate-50 border border-slate-200 rounded-lg text-slate-600 text-xs focus:ring-blue-500 focus:border-blue-500 p-1 mx-1 outline-none">
        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
    </select>
    of {{ $accounts->total() }} data
</div>

<!-- Right: Customized visual pagination -->
<div>
    {{ $accounts->links('vendor.pagination.custom') }}
</div>
