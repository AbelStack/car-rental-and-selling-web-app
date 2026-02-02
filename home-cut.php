3️⃣ FRONT LAYER - SMART BOOKING INTERFACE (FLOATING)
    <div class="absolute bottom-0 left-0 right-0 z-30 smart-booking-dock">
        <!-- Floating Glass Panel - Premium Car Dashboard Feel -->
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="smart-search-dock opacity-0 transform translate-y-8" style="animation: slideInUp 0.8s ease-out 1.8s forwards;">
                <div class="bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/50 p-8 mb-8 mx-auto max-w-6xl">
                    <!-- Service Type Toggle -->
                    <div class="flex justify-center mb-8">
                        <div class="bg-slate-100 rounded-2xl p-2 inline-flex">
                            <button onclick="switchServiceType('sales')" id="sales-service" class="service-toggle active px-8 py-3 rounded-xl font-semibold transition-all duration-300">
                                <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                                {{ app()->getLocale() === 'am' ? 'ግዢ' : 'Buy' }}
                            </button>
                        </div>
                    </div>
                    
                    <!-- Sales Interface -->
                    <div id="sales-interface" class="booking-interface">
                        <form action="{{ route('vehicles.sales') }}" method="GET" class="space-y-6">
                            <!-- Search and Filter Options for Sales -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="input-group">
                                    <div class="input-icon">
                                        <svg class="w-5 h-5 text-neon-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                        </svg>
                                    </div>
                                    <input type="text" name="make" placeholder="{{ app()->getLocale() === 'am' ? 'የመኪና ስም ወይም ሞዴል' : 'Car Make or Model' }}" 
                                           class="smart-input" autocomplete="off" value="{{ request('make') }}">
                                    <div class="input-ripple"></div>
                                </div>
                                
                                <div class="input-group">
                                    <div class="input-icon">
                                        <svg class="w-5 h-5 text-light-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                        </svg>
                                    </div>
                                    <select name="price_range" class="smart-input">
                                        <option value="">{{ app()->getLocale() === 'am' ? 'የዋጋ ክልል' : 'Price Range' }}</option>
                                        <option value="0-10000" {{ request('price_range') == '0-10000' ? 'selected' : '' }}>$0 - $10,000</option>
                                        <option value="10000-25000" {{ request('price_range') == '10000-25000' ? 'selected' : '' }}>$10,000 - $25,000</option>
                                        <option value="25000-50000" {{ request('price_range') == '25000-50000' ? 'selected' : '' }}>$25,000 - $50,000</option>
                                        <option value="50000-100000" {{ request('price_range') == '50000-100000' ? 'selected' : '' }}>$50,000 - $100,000</option>
                                        <option value="100000+" {{ request('price_range') == '100000+' ? 'selected' : '' }}>$100,000+</option>
                                    </select>
                                    <div class="input-ripple"></div>
                                </div>
                                
                                <div class="input-group">
                                    <div class="input-icon">
                                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                                        </svg>
                                    </div>
                                    <select name="category" class="smart-input">
                                        <option value="">{{ app()->getLocale() === 'am' ? 'የመኪና ዓይነት' : 'Vehicle Category' }}</option>
                                        <option value="sedan" {{ request('category') == 'sedan' ? 'selected' : '' }}>{{ app()->getLocale() === 'am' ? 'ሴዳን' : 'Sedan' }}</option>
                                        <option value="suv" {{ request('category') == 'suv' ? 'selected' : '' }}>SUV</option>
                                        <option value="hatchback" {{ request('category') == 'hatchback' ? 'selected' : '' }}>{{ app()->getLocale() === 'am' ? 'ሃችባክ' : 'Hatchback' }}</option>
                                        <option value="coupe" {{ request('category') == 'coupe' ? 'selected' : '' }}>{{ app()->getLocale() === 'am' ? 'ኩፔ' : 'Coupe' }}</option>
                                        <option value="convertible" {{ request('category') == 'convertible' ? 'selected' : '' }}>{{ app()->getLocale() === 'am' ? 'ኮንቨርቲብል' : 'Convertible' }}</option>
                                        <option value="truck" {{ request('category') == 'truck' ? 'selected' : '' }}>{{ app()->getLocale() === 'am' ? 'ትራክ' : 'Truck' }}</option>
                                        <option value="luxury" {{ request('category') == 'luxury' ? 'selected' : '' }}>{{ app()->getLocale() === 'am' ? 'ቅንጦት' : 'Luxury' }}</option>
                                    </select>
                                    <div class="input-ripple"></div>
                                </div>
                            </div>
                            
                            <!-- Additional Filters -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="input-group">
                                    <div class="input-icon">
                                        <svg class="w-5 h-5 text-neon-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <select name="year_range" class="smart-input">
                                        <option value="">{{ app()->getLocale() === 'am' ? 'የአመት ክልል' : 'Year Range' }}</option>
                                        <option value="2020-2024" {{ request('year_range') == '2020-2024' ? 'selected' : '' }}>2020 - 2024</option>
                                        <option value="2015-2019" {{ request('year_range') == '2015-2019' ? 'selected' : '' }}>2015 - 2019</option>
                                        <option value="2010-2014" {{ request('year_range') == '2010-2014' ? 'selected' : '' }}>2010 - 2014</option>
                                        <option value="2005-2009" {{ request('year_range') == '2005-2009' ? 'selected' : '' }}>2005 - 2009</option>
                                        <option value="2000-2004" {{ request('year_range') == '2000-2004' ? 'selected' : '' }}>2000 - 2004</option>
                                    </select>
                                    <div class="input-ripple"></div>
                                </div>
                                
                                <div class="input-group">
                                    <div class="input-icon">
                                        <svg class="w-5 h-5 text-light-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <select name="condition" class="smart-input">
                                        <option value="">{{ app()->getLocale() === 'am' ? 'ሁኔታ' : 'Condition' }}</option>
                                        <option value="new" {{ request('condition') == 'new' ? 'selected' : '' }}>{{ app()->getLocale() === 'am' ? 'አዲስ' : 'New' }}</option>
                                        <option value="excellent" {{ request('condition') == 'excellent' ? 'selected' : '' }}>{{ app()->getLocale() === 'am' ? 'በጣም ጥሩ' : 'Excellent' }}</option>
                                        <option value="good" {{ request('condition') == 'good' ? 'selected' : '' }}>{{ app()->getLocale() === 'am' ? 'ጥሩ' : 'Good' }}</option>
                                        <option value="fair" {{ request('condition') == 'fair' ? 'selected' : '' }}>{{ app()->getLocale() === 'am' ? 'መካከለኛ' : 'Fair' }}</option>
                                    </select>
                                    <div class="input-ripple"></div>
                                </div>
                            </div>
                            
                            <!-- CTA Button -->
                            <div class="flex justify-end">
                                <button type="submit" class="cta-book-now">
                                    <span class="cta-text">{{ app()->getLocale() === 'am' ? 'መኪናዎችን ይመልከቱ' : 'Browse Vehicles' }}</span>
                                    <svg class="w-6 h-6 ml-3 cta-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                    <div class="cta-ripple"></div>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>