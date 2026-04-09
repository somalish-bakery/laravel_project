<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <div class="space-y-8">
                <h2 class="text-4xl font-bold">Contact Us</h2>
                <p class="text-gray-500">Have questions? We'd love to hear from you.</p>
                
                <div class="space-y-4">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-orange-100 text-orange-600 rounded-full flex items-center justify-center">📞</div>
                        <div>
                            <p class="font-bold">Phone</p>
                            <p class="text-gray-600">+855 12 345 678</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-orange-100 text-orange-600 rounded-full flex items-center justify-center">📧</div>
                        <div>
                            <p class="font-bold">Email</p>
                            <p class="text-gray-600">info@khmerkitchen.com</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-orange-100 text-orange-600 rounded-full flex items-center justify-center">📍</div>
                        <div>
                            <p class="font-bold">Location</p>
                            <p class="text-gray-600">Phnom Penh, Cambodia</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="h-[450px] rounded-[2rem] overflow-hidden shadow-lg border-4 border-white">
                <iframe 
                    width="100%" height="100%" 
                    src="https://maps.google.com/maps?q=Phnom%20Penh&t=&z=13&ie=UTF8&iwloc=&output=embed" 
                    frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
                </iframe>
            </div>
        </div>
    </div>
</x-app-layout>