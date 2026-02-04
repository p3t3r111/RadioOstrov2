<div class="">
    <div class="">
        <h2 class="text-lg font-medium text-gray-900 mb-4">Váš pozývací odkaz</h2>
        <p class="mb-4 text-sm text-gray-600">
            Zdieľajte tento odkaz s priateľmi, aby sa mohli pripojiť k Rádio ostrov. Každý nový používateľ, ktorý sa
            zaregistruje pomocou tohto odkazu, vám poskytne extra výhody.
        </p>
    </div>
    <div class="relative w-[60%]">
        <input disabled class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 cursor-not-allowed shadow-sm"
            value="{{ url('/r/' . $invite_code) }}">
        <button class="copy-btn absolute right-2 top-2 rounded bg-gray-200 px-2 py-1 text-sm font-semibold text-gray-700 hover:bg-gray-300" data-copy="{{ url('/r/' . $invite_code) }}">Kopírovať odkaz</button>
    </div>

</div>

<script>
    document.querySelectorAll('.copy-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            navigator.clipboard.writeText(btn.dataset.copy);
            btn.textContent = 'Odkaz skopírovaný!';
            setTimeout(() => {
                btn.textContent = 'Kopírovať odkaz';
            }, 2000);
        });
    });
</script>
