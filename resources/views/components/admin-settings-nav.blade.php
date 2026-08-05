<div class="bg-white rounded-2xl p-2 shadow-sm border border-gray-100 mb-6 flex flex-wrap gap-2">
    <a href="{{ route('admin.settings.contact.index') }}" 
       class="flex items-center gap-2.5 px-5 py-3 rounded-xl font-bold text-sm transition-all duration-200 {{ request()->routeIs('admin.settings.contact.*') ? 'bg-brand-purple text-white shadow-md shadow-brand-purple/20' : 'text-gray-600 hover:text-brand-purple hover:bg-gray-50' }}">
        <i class="fa-solid fa-address-book text-base"></i>
        <span>General & Contact</span>
    </a>

    <a href="{{ route('admin.settings.payment.index') }}" 
       class="flex items-center gap-2.5 px-5 py-3 rounded-xl font-bold text-sm transition-all duration-200 {{ request()->routeIs('admin.settings.payment.*') ? 'bg-brand-purple text-white shadow-md shadow-brand-purple/20' : 'text-gray-600 hover:text-brand-purple hover:bg-gray-50' }}">
        <i class="fa-solid fa-qrcode text-base"></i>
        <span>Payment & QR</span>
    </a>

    <a href="{{ route('admin.settings.admit-card.index') }}" 
       class="flex items-center gap-2.5 px-5 py-3 rounded-xl font-bold text-sm transition-all duration-200 {{ request()->routeIs('admin.settings.admit-card.*') ? 'bg-brand-purple text-white shadow-md shadow-brand-purple/20' : 'text-gray-600 hover:text-brand-purple hover:bg-gray-50' }}">
        <i class="fa-solid fa-id-card text-base"></i>
        <span>Admit Card</span>
    </a>

    <a href="{{ route('admin.settings.about-us.index') }}" 
       class="flex items-center gap-2.5 px-5 py-3 rounded-xl font-bold text-sm transition-all duration-200 {{ request()->routeIs('admin.settings.about-us.*') ? 'bg-brand-purple text-white shadow-md shadow-brand-purple/20' : 'text-gray-600 hover:text-brand-purple hover:bg-gray-50' }}">
        <i class="fa-solid fa-circle-info text-base"></i>
        <span>About Us Page</span>
    </a>
</div>
