@extends('layouts.app')

@section('title', 'Book ' . $vehicle->full_name . ' - Addis Drive Vehicle Services')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8 animate__animated animate__fadeInDown">
            <h1 class="text-3xl font-bold text-gray-900">
                @if(app()->getLocale() === 'am')
                    ቦታ ያስያዙ
                @else
                    Book Your Rental
                @endif
            </h1>
            <p class="mt-2 text-gray-600">
                @if(app()->getLocale() === 'am')
                    {{ $vehicle->full_name }} ን ይከራዩ
                @else
                    Complete your booking for {{ $vehicle->full_name }}
                @endif
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Booking Form -->
            <div class="lg:col-span-2">
                <div class="bg-white shadow rounded-lg p-6 animate__animated animate__fadeInLeft">
                    <form method="POST" action="{{ route('bookings.store', $vehicle) }}" id="booking-form">
                        @csrf
                        
                        <!-- Rental Dates -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">
                                @if(app()->getLocale() === 'am')
                                    የኪራይ ቀናት
                                @else
                                    Rental Dates
                                @endif
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="pickup_date" class="block text-sm font-medium text-gray-700 mb-2">
                                        @if(app()->getLocale() === 'am')
                                            የመውሰጃ ቀን
                                        @else
                                            Pickup Date
                                        @endif
                                    </label>
                                    <input type="date" 
                                           id="pickup_date" 
                                           name="pickup_date" 
                                           required
                                           min="{{ date('Y-m-d') }}"
                                           value="{{ old('pickup_date') }}"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('pickup_date') border-red-500 @enderror"
                                           onchange="updateDates()">
                                    @error('pickup_date')
                                        <div class="mt-2 p-4 bg-red-50 border border-red-200 rounded-md">
                                            <div class="flex">
                                                <div class="flex-shrink-0">
                                                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                <div class="ml-3">
                                                    <h3 class="text-sm font-medium text-red-800">
                                                        @if(app()->getLocale() === 'am')
                                                            ተሽከርካሪው አይገኝም
                                                        @else
                                                            Vehicle Not Available
                                                        @endif
                                                    </h3>
                                                    <div class="mt-2 text-sm text-red-700">
                                                        @php
                                                            $lines = explode("\n", $message);
                                                            $mainMessage = array_shift($lines);
                                                        @endphp
                                                        <p class="font-medium">{{ $mainMessage }}</p>
                                                        
                                                        @if(!empty($lines))
                                                            <div class="mt-3">
                                                                @foreach($lines as $line)
                                                                    @if(trim($line))
                                                                        @if(str_starts_with(trim($line), '•'))
                                                                            <div class="flex items-start mt-1">
                                                                                <span class="text-red-500 mr-2">•</span>
                                                                                <span>{{ trim(substr($line, 1)) }}</span>
                                                                            </div>
                                                                        @elseif(str_starts_with(trim($line), 'Earliest available date:'))
                                                                            <div class="mt-3 p-2 bg-green-50 border border-green-200 rounded">
                                                                                <div class="flex items-center">
                                                                                    <svg class="h-4 w-4 text-green-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                                                    </svg>
                                                                                    <span class="text-sm font-medium text-green-800">{{ trim($line) }}</span>
                                                                                </div>
                                                                            </div>
                                                                        @else
                                                                            <p class="mt-1">{{ trim($line) }}</p>
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label for="return_date" class="block text-sm font-medium text-gray-700 mb-2">
                                        @if(app()->getLocale() === 'am')
                                            የመመለሻ ቀን
                                        @else
                                            Return Date
                                        @endif
                                    </label>
                                    <input type="date" 
                                           id="return_date" 
                                           name="return_date" 
                                           required
                                           min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                           value="{{ old('return_date') }}"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('return_date') border-red-500 @enderror"
                                           onchange="updateDates()">
                                    @error('return_date')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Driving Option -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">
                                @if(app()->getLocale() === 'am')
                                    የማሽከርከር አማራጭ
                                @else
                                    Driving Option
                                @endif
                            </h3>
                            
                            <div class="space-y-4">
                                @if($vehicle->self_drive_available)
                                    <div class="flex items-center">
                                        <input id="self_drive" 
                                               name="driving_option" 
                                               type="radio" 
                                               value="self_drive"
                                               {{ old('driving_option', 'self_drive') === 'self_drive' ? 'checked' : '' }}
                                               class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300"
                                               onchange="updatePricing()">
                                        <label for="self_drive" class="ml-3 block text-sm font-medium text-gray-700">
                                            @if(app()->getLocale() === 'am')
                                                ራስዎ ይንዱ
                                            @else
                                                Self Drive
                                            @endif
                                            <span class="text-gray-500">
                                                (ETB {{ number_format($vehicle->rental_price_per_day, 0) }}/day)
                                            </span>
                                        </label>
                                    </div>
                                @endif
                                
                                @if($vehicle->with_driver_available)
                                    <div class="flex items-center">
                                        <input id="with_driver" 
                                               name="driving_option" 
                                               type="radio" 
                                               value="with_driver"
                                               {{ old('driving_option') === 'with_driver' ? 'checked' : '' }}
                                               class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300"
                                               onchange="updatePricing()">
                                        <label for="with_driver" class="ml-3 block text-sm font-medium text-gray-700">
                                            @if(app()->getLocale() === 'am')
                                                ከሹፌር ጋር
                                            @else
                                                With Driver
                                            @endif
                                            <span class="text-gray-500">
                                                (ETB {{ number_format($vehicle->rental_price_per_day, 0) }} + ETB {{ number_format($vehicle->driver_cost_per_day ?? 0, 0) }}/day)
                                            </span>
                                        </label>
                                    </div>
                                @endif
                            </div>
                            @error('driving_option')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Location Details -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">
                                @if(app()->getLocale() === 'am')
                                    የአካባቢ ዝርዝሮች
                                @else
                                    Location Details
                                @endif
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="pickup_location" class="block text-sm font-medium text-gray-700 mb-2">
                                        @if(app()->getLocale() === 'am')
                                            የመውሰጃ ቦታ
                                        @else
                                            Pickup Location
                                        @endif
                                    </label>
                                    <select id="pickup_location" 
                                            name="pickup_location" 
                                            required
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('pickup_location') border-red-500 @enderror">
                                        <option value="">
                                            @if(app()->getLocale() === 'am')
                                                የመውሰጃ ቦታ ይምረጡ
                                            @else
                                                Select pickup location
                                            @endif
                                        </option>
                                        
                                        <!-- Addis Ababa Areas -->
                                        <optgroup label="@if(app()->getLocale() === 'am') አዲስ አበባ @else Addis Ababa @endif">
                                            <option value="Bole International Airport" {{ old('pickup_location') == 'Bole International Airport' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ቦሌ አለም አቀፍ አውሮፕላን ማረፊያ @else Bole International Airport @endif
                                            </option>
                                            <option value="Bole Atlas" {{ old('pickup_location') == 'Bole Atlas' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ቦሌ አትላስ @else Bole Atlas @endif
                                            </option>
                                            <option value="Kazanchis" {{ old('pickup_location') == 'Kazanchis' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ካዛንቺስ @else Kazanchis @endif
                                            </option>
                                            <option value="Piazza" {{ old('pickup_location') == 'Piazza' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ፒያሳ @else Piazza @endif
                                            </option>
                                            <option value="Merkato" {{ old('pickup_location') == 'Merkato' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') መርካቶ @else Merkato @endif
                                            </option>
                                            <option value="4 Kilo" {{ old('pickup_location') == '4 Kilo' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') 4 ኪሎ @else 4 Kilo @endif
                                            </option>
                                            <option value="6 Kilo" {{ old('pickup_location') == '6 Kilo' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') 6 ኪሎ @else 6 Kilo @endif
                                            </option>
                                            <option value="Arat Kilo" {{ old('pickup_location') == 'Arat Kilo' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') አራት ኪሎ @else Arat Kilo @endif
                                            </option>
                                            <option value="Mexico" {{ old('pickup_location') == 'Mexico' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ሜክሲኮ @else Mexico @endif
                                            </option>
                                            <option value="Legehar" {{ old('pickup_location') == 'Legehar' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ለገሃር @else Legehar @endif
                                            </option>
                                            <option value="CMC" {{ old('pickup_location') == 'CMC' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ሲ.ኤም.ሲ @else CMC @endif
                                            </option>
                                            <option value="Megenagna" {{ old('pickup_location') == 'Megenagna' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') መገናኛ @else Megenagna @endif
                                            </option>
                                            <option value="Hayat" {{ old('pickup_location') == 'Hayat' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ሃያት @else Hayat @endif
                                            </option>
                                            <option value="Sarbet" {{ old('pickup_location') == 'Sarbet' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ሳርቤት @else Sarbet @endif
                                            </option>
                                            <option value="Gerji" {{ old('pickup_location') == 'Gerji' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ገርጂ @else Gerji @endif
                                            </option>
                                            <option value="Jemo" {{ old('pickup_location') == 'Jemo' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ጀሞ @else Jemo @endif
                                            </option>
                                            <option value="Kality" {{ old('pickup_location') == 'Kality' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ቃሊቲ @else Kality @endif
                                            </option>
                                            <option value="Kotebe" {{ old('pickup_location') == 'Kotebe' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ኮተቤ @else Kotebe @endif
                                            </option>
                                        </optgroup>
                                        
                                        <!-- Other Major Cities -->
                                        <optgroup label="@if(app()->getLocale() === 'am') ሌሎች ከተሞች @else Other Cities @endif">
                                            <option value="Bahir Dar" {{ old('pickup_location') == 'Bahir Dar' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ባህር ዳር @else Bahir Dar @endif
                                            </option>
                                            <option value="Gondar" {{ old('pickup_location') == 'Gondar' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ጎንደር @else Gondar @endif
                                            </option>
                                            <option value="Mekelle" {{ old('pickup_location') == 'Mekelle' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') መቀሌ @else Mekelle @endif
                                            </option>
                                            <option value="Hawassa" {{ old('pickup_location') == 'Hawassa' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ሐዋሳ @else Hawassa @endif
                                            </option>
                                            <option value="Dire Dawa" {{ old('pickup_location') == 'Dire Dawa' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ድሬ ዳዋ @else Dire Dawa @endif
                                            </option>
                                            <option value="Adama (Nazret)" {{ old('pickup_location') == 'Adama (Nazret)' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') አዳማ (ናዝሬት) @else Adama (Nazret) @endif
                                            </option>
                                            <option value="Jimma" {{ old('pickup_location') == 'Jimma' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ጅማ @else Jimma @endif
                                            </option>
                                            <option value="Dessie" {{ old('pickup_location') == 'Dessie' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ደሴ @else Dessie @endif
                                            </option>
                                            <option value="Bishoftu (Debre Zeit)" {{ old('pickup_location') == 'Bishoftu (Debre Zeit)' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ቢሾፍቱ (ደብረ ዘይት) @else Bishoftu (Debre Zeit) @endif
                                            </option>
                                        </optgroup>
                                        
                                        <!-- Hotels & Landmarks -->
                                        <optgroup label="@if(app()->getLocale() === 'am') ሆቴሎች እና ምልክቶች @else Hotels & Landmarks @endif">
                                            <option value="Sheraton Addis Hotel" {{ old('pickup_location') == 'Sheraton Addis Hotel' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ሼራተን አዲስ ሆቴል @else Sheraton Addis Hotel @endif
                                            </option>
                                            <option value="Hilton Addis Ababa" {{ old('pickup_location') == 'Hilton Addis Ababa' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ሂልተን አዲስ አበባ @else Hilton Addis Ababa @endif
                                            </option>
                                            <option value="Radisson Blu Hotel" {{ old('pickup_location') == 'Radisson Blu Hotel' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ራዲሰን ብሉ ሆቴል @else Radisson Blu Hotel @endif
                                            </option>
                                            <option value="Hyatt Regency Addis Ababa" {{ old('pickup_location') == 'Hyatt Regency Addis Ababa' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ሃያት ሪጀንሲ አዲስ አበባ @else Hyatt Regency Addis Ababa @endif
                                            </option>
                                            <option value="National Theatre" {{ old('pickup_location') == 'National Theatre' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ብሔራዊ ቲያትር @else National Theatre @endif
                                            </option>
                                            <option value="Unity Park" {{ old('pickup_location') == 'Unity Park' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') አንድነት ፓርክ @else Unity Park @endif
                                            </option>
                                            <option value="Meskel Square" {{ old('pickup_location') == 'Meskel Square' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') መስቀል አደባባይ @else Meskel Square @endif
                                            </option>
                                        </optgroup>
                                        
                                        <!-- Custom Option -->
                                        <option value="other" {{ old('pickup_location') == 'other' ? 'selected' : '' }}>
                                            @if(app()->getLocale() === 'am') ሌላ (በዝርዝር ይግለጹ) @else Other (specify below) @endif
                                        </option>
                                    </select>
                                    
                                    <!-- Custom location input (shown when "Other" is selected) -->
                                    <div id="pickup_custom_location" style="display: none;" class="mt-2">
                                        <input type="text" 
                                               id="pickup_location_custom" 
                                               name="pickup_location_custom"
                                               placeholder="@if(app()->getLocale() === 'am') የመውሰጃ ቦታ ያስገቡ @else Enter pickup location @endif"
                                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    </div>
                                    
                                    @error('pickup_location')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label for="return_location" class="block text-sm font-medium text-gray-700 mb-2">
                                        @if(app()->getLocale() === 'am')
                                            የመመለሻ ቦታ
                                        @else
                                            Return Location
                                        @endif
                                    </label>
                                    <select id="return_location" 
                                            name="return_location" 
                                            required
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('return_location') border-red-500 @enderror">
                                        <option value="">
                                            @if(app()->getLocale() === 'am')
                                                የመመለሻ ቦታ ይምረጡ
                                            @else
                                                Select return location
                                            @endif
                                        </option>
                                        
                                        <!-- Same as pickup location -->
                                        <option value="same_as_pickup" {{ old('return_location') == 'same_as_pickup' ? 'selected' : '' }}>
                                            @if(app()->getLocale() === 'am') ከመውሰጃ ቦታ ጋር ተመሳሳይ @else Same as pickup location @endif
                                        </option>
                                        
                                        <!-- Addis Ababa Areas -->
                                        <optgroup label="@if(app()->getLocale() === 'am') አዲስ አበባ @else Addis Ababa @endif">
                                            <option value="Bole International Airport" {{ old('return_location') == 'Bole International Airport' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ቦሌ አለም አቀፍ አውሮፕላን ማረፊያ @else Bole International Airport @endif
                                            </option>
                                            <option value="Bole Atlas" {{ old('return_location') == 'Bole Atlas' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ቦሌ አትላስ @else Bole Atlas @endif
                                            </option>
                                            <option value="Kazanchis" {{ old('return_location') == 'Kazanchis' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ካዛንቺስ @else Kazanchis @endif
                                            </option>
                                            <option value="Piazza" {{ old('return_location') == 'Piazza' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ፒያሳ @else Piazza @endif
                                            </option>
                                            <option value="Merkato" {{ old('return_location') == 'Merkato' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') መርካቶ @else Merkato @endif
                                            </option>
                                            <option value="4 Kilo" {{ old('return_location') == '4 Kilo' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') 4 ኪሎ @else 4 Kilo @endif
                                            </option>
                                            <option value="6 Kilo" {{ old('return_location') == '6 Kilo' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') 6 ኪሎ @else 6 Kilo @endif
                                            </option>
                                            <option value="Arat Kilo" {{ old('return_location') == 'Arat Kilo' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') አራት ኪሎ @else Arat Kilo @endif
                                            </option>
                                            <option value="Mexico" {{ old('return_location') == 'Mexico' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ሜክሲኮ @else Mexico @endif
                                            </option>
                                            <option value="Legehar" {{ old('return_location') == 'Legehar' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ለገሃር @else Legehar @endif
                                            </option>
                                            <option value="CMC" {{ old('return_location') == 'CMC' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ሲ.ኤም.ሲ @else CMC @endif
                                            </option>
                                            <option value="Megenagna" {{ old('return_location') == 'Megenagna' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') መገናኛ @else Megenagna @endif
                                            </option>
                                            <option value="Hayat" {{ old('return_location') == 'Hayat' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ሃያት @else Hayat @endif
                                            </option>
                                            <option value="Sarbet" {{ old('return_location') == 'Sarbet' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ሳርቤት @else Sarbet @endif
                                            </option>
                                            <option value="Gerji" {{ old('return_location') == 'Gerji' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ገርጂ @else Gerji @endif
                                            </option>
                                            <option value="Jemo" {{ old('return_location') == 'Jemo' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ጀሞ @else Jemo @endif
                                            </option>
                                            <option value="Kality" {{ old('return_location') == 'Kality' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ቃሊቲ @else Kality @endif
                                            </option>
                                            <option value="Kotebe" {{ old('return_location') == 'Kotebe' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ኮተቤ @else Kotebe @endif
                                            </option>
                                        </optgroup>
                                        
                                        <!-- Other Major Cities -->
                                        <optgroup label="@if(app()->getLocale() === 'am') ሌሎች ከተሞች @else Other Cities @endif">
                                            <option value="Bahir Dar" {{ old('return_location') == 'Bahir Dar' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ባህር ዳር @else Bahir Dar @endif
                                            </option>
                                            <option value="Gondar" {{ old('return_location') == 'Gondar' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ጎንደር @else Gondar @endif
                                            </option>
                                            <option value="Mekelle" {{ old('return_location') == 'Mekelle' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') መቀሌ @else Mekelle @endif
                                            </option>
                                            <option value="Hawassa" {{ old('return_location') == 'Hawassa' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ሐዋሳ @else Hawassa @endif
                                            </option>
                                            <option value="Dire Dawa" {{ old('return_location') == 'Dire Dawa' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ድሬ ዳዋ @else Dire Dawa @endif
                                            </option>
                                            <option value="Adama (Nazret)" {{ old('return_location') == 'Adama (Nazret)' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') አዳማ (ናዝሬት) @else Adama (Nazret) @endif
                                            </option>
                                            <option value="Jimma" {{ old('return_location') == 'Jimma' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ጅማ @else Jimma @endif
                                            </option>
                                            <option value="Dessie" {{ old('return_location') == 'Dessie' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ደሴ @else Dessie @endif
                                            </option>
                                            <option value="Bishoftu (Debre Zeit)" {{ old('return_location') == 'Bishoftu (Debre Zeit)' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ቢሾፍቱ (ደብረ ዘይት) @else Bishoftu (Debre Zeit) @endif
                                            </option>
                                        </optgroup>
                                        
                                        <!-- Hotels & Landmarks -->
                                        <optgroup label="@if(app()->getLocale() === 'am') ሆቴሎች እና ምልክቶች @else Hotels & Landmarks @endif">
                                            <option value="Sheraton Addis Hotel" {{ old('return_location') == 'Sheraton Addis Hotel' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ሼራተን አዲስ ሆቴል @else Sheraton Addis Hotel @endif
                                            </option>
                                            <option value="Hilton Addis Ababa" {{ old('return_location') == 'Hilton Addis Ababa' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ሂልተን አዲስ አበባ @else Hilton Addis Ababa @endif
                                            </option>
                                            <option value="Radisson Blu Hotel" {{ old('return_location') == 'Radisson Blu Hotel' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ራዲሰን ብሉ ሆቴል @else Radisson Blu Hotel @endif
                                            </option>
                                            <option value="Hyatt Regency Addis Ababa" {{ old('return_location') == 'Hyatt Regency Addis Ababa' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ሃያት ሪጀንሲ አዲስ አበባ @else Hyatt Regency Addis Ababa @endif
                                            </option>
                                            <option value="National Theatre" {{ old('return_location') == 'National Theatre' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') ብሔራዊ ቲያትር @else National Theatre @endif
                                            </option>
                                            <option value="Unity Park" {{ old('return_location') == 'Unity Park' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') አንድነት ፓርክ @else Unity Park @endif
                                            </option>
                                            <option value="Meskel Square" {{ old('return_location') == 'Meskel Square' ? 'selected' : '' }}>
                                                @if(app()->getLocale() === 'am') መስቀል አደባባይ @else Meskel Square @endif
                                            </option>
                                        </optgroup>
                                        
                                        <!-- Custom Option -->
                                        <option value="other" {{ old('return_location') == 'other' ? 'selected' : '' }}>
                                            @if(app()->getLocale() === 'am') ሌላ (በዝርዝር ይግለጹ) @else Other (specify below) @endif
                                        </option>
                                    </select>
                                    
                                    <!-- Custom location input (shown when "Other" is selected) -->
                                    <div id="return_custom_location" style="display: none;" class="mt-2">
                                        <input type="text" 
                                               id="return_location_custom" 
                                               name="return_location_custom"
                                               placeholder="@if(app()->getLocale() === 'am') የመመለሻ ቦታ ያስገቡ @else Enter return location @endif"
                                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    </div>
                                    
                                    @error('return_location')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Hidden GPS coordinates (can be populated by map integration) -->
                            <input type="hidden" name="pickup_latitude" id="pickup_latitude" value="{{ old('pickup_latitude') }}">
                            <input type="hidden" name="pickup_longitude" id="pickup_longitude" value="{{ old('pickup_longitude') }}">
                            <input type="hidden" name="return_latitude" id="return_latitude" value="{{ old('return_latitude') }}">
                            <input type="hidden" name="return_longitude" id="return_longitude" value="{{ old('return_longitude') }}">
                        </div>

                        <!-- Special Requests -->
                        <div class="mb-6">
                            <label for="special_requests" class="block text-sm font-medium text-gray-700 mb-2">
                                @if(app()->getLocale() === 'am')
                                    ልዩ ጥያቄዎች
                                @else
                                    Special Requests
                                @endif
                                <span class="text-gray-500">({{ __('Optional') }})</span>
                            </label>
                            <textarea id="special_requests" 
                                      name="special_requests" 
                                      rows="3"
                                      placeholder="@if(app()->getLocale() === 'am') ማንኛውም ልዩ ጥያቄ ወይም መመሪያ... @else Any special requests or instructions... @endif"
                                      class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('special_requests') border-red-500 @enderror">{{ old('special_requests') }}</textarea>
                            @error('special_requests')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" 
                                    class="bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 font-medium animate-ripple animate-scale-on-hover">
                                @if(app()->getLocale() === 'am')
                                    ቦታ ያስያዙ
                                @else
                                    Complete Booking
                                @endif
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Booking Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white shadow rounded-lg p-6 sticky top-8 animate__animated animate__fadeInRight">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">
                        @if(app()->getLocale() === 'am')
                            የቦታ ማስያዝ ማጠቃለያ
                        @else
                            Booking Summary
                        @endif
                    </h3>
                    
                    <!-- Vehicle Info -->
                    <div class="flex items-center mb-4">
                        @if($vehicle->primary_image)
                            <img src="{{ $vehicle->primary_image }}" 
                                 alt="{{ $vehicle->full_name }}" 
                                 class="w-16 h-16 object-cover rounded">
                        @else
                            <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                                <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        @endif
                        <div class="ml-4">
                            <h4 class="font-medium text-gray-900">{{ $vehicle->full_name }}</h4>
                            <p class="text-sm text-gray-500">{{ ucfirst($vehicle->category) }} • {{ ucfirst($vehicle->transmission) }}</p>
                        </div>
                    </div>

                    <!-- Pricing Breakdown -->
                    <div class="border-t border-gray-200 pt-4">
                        <div class="space-y-2">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">
                                    @if(app()->getLocale() === 'am')
                                        የቀን ዋጋ
                                    @else
                                        Daily Rate
                                    @endif
                                </span>
                                <span id="daily-rate">ETB {{ number_format($vehicle->rental_price_per_day, 0) }}</span>
                            </div>
                            
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">
                                    @if(app()->getLocale() === 'am')
                                        የቀናት ብዛት
                                    @else
                                        Number of Days
                                    @endif
                                </span>
                                <span id="total-days">1</span>
                            </div>
                            
                            <div class="flex justify-between text-sm" id="driver-cost-row" style="display: none;">
                                <span class="text-gray-600">
                                    @if(app()->getLocale() === 'am')
                                        የሹፌር ወጪ
                                    @else
                                        Driver Cost
                                    @endif
                                </span>
                                <span id="driver-cost">$0</span>
                            </div>
                            
                            <div class="flex justify-between text-sm border-t pt-2">
                                <span class="text-gray-600">
                                    @if(app()->getLocale() === 'am')
                                        ንዑስ ድምር
                                    @else
                                        Subtotal
                                    @endif
                                </span>
                                <span id="subtotal">ETB {{ number_format($vehicle->rental_price_per_day, 0) }}</span>
                            </div>
                            
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">
                                    @if(app()->getLocale() === 'am')
                                        ታክስ (15%)
                                    @else
                                        Tax (15%)
                                    @endif
                                </span>
                                <span id="tax-amount">ETB {{ number_format($vehicle->rental_price_per_day * 0.15, 0) }}</span>
                            </div>
                            
                            <div class="flex justify-between font-medium text-lg border-t pt-2">
                                <span class="text-gray-900">
                                    @if(app()->getLocale() === 'am')
                                        ጠቅላላ
                                    @else
                                        Total
                                    @endif
                                </span>
                                <span id="total-amount" class="text-blue-600">ETB {{ number_format($vehicle->rental_price_per_day * 1.15, 0) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Important Notes -->
                    <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                        <h4 class="text-sm font-medium text-blue-900 mb-2">
                            @if(app()->getLocale() === 'am')
                                አስፈላጊ ማስታወሻዎች
                            @else
                                Important Notes
                            @endif
                        </h4>
                        <ul class="text-xs text-blue-800 space-y-1">
                            <li>
                                @if(app()->getLocale() === 'am')
                                    • ክፍያ ከመጠናቀቁ በፊት ቦታ ማስያዝ አይረጋገጥም
                                @else
                                    • Booking is not confirmed until payment is completed
                                @endif
                            </li>
                            <li>
                                @if(app()->getLocale() === 'am')
                                    • የመንጃ ፈቃድ እና መታወቂያ ያስፈልጋል
                                @else
                                    • Valid driver's license and ID required
                                @endif
                            </li>
                            <li>
                                @if(app()->getLocale() === 'am')
                                    • የመሰረዝ ፖሊሲ ይተገበራል
                                @else
                                    • Cancellation policy applies
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const vehicleData = {
    dailyRate: {{ $vehicle->rental_price_per_day }},
    driverCost: {{ $vehicle->driver_cost_per_day ?? 0 }}
};

function updateDates() {
    const pickupDate = document.getElementById('pickup_date').value;
    const returnDate = document.getElementById('return_date').value;
    
    if (pickupDate && returnDate) {
        const pickup = new Date(pickupDate);
        const returnD = new Date(returnDate);
        const timeDiff = returnD.getTime() - pickup.getTime();
        const daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24)) + 1;
        
        if (daysDiff > 0) {
            document.getElementById('total-days').textContent = daysDiff;
            updatePricing();
        }
    }
    
    // Update minimum return date
    if (pickupDate) {
        const minReturn = new Date(pickupDate);
        minReturn.setDate(minReturn.getDate() + 1);
        document.getElementById('return_date').min = minReturn.toISOString().split('T')[0];
    }
}

function updatePricing() {
    const totalDays = parseInt(document.getElementById('total-days').textContent) || 1;
    const drivingOption = document.querySelector('input[name="driving_option"]:checked')?.value || 'self_drive';
    
    const dailyRate = vehicleData.dailyRate;
    const driverCostPerDay = drivingOption === 'with_driver' ? vehicleData.driverCost : 0;
    
    const rentalCost = dailyRate * totalDays;
    const totalDriverCost = driverCostPerDay * totalDays;
    const subtotal = rentalCost + totalDriverCost;
    const taxAmount = subtotal * 0.15;
    const total = subtotal + taxAmount;
    
    // Update display
    document.getElementById('daily-rate').textContent = `$${dailyRate}`;
    
    const driverCostRow = document.getElementById('driver-cost-row');
    if (driverCostPerDay > 0) {
        driverCostRow.style.display = 'flex';
        document.getElementById('driver-cost').textContent = `ETB ${Math.round(totalDriverCost).toLocaleString()}`;
    } else {
        driverCostRow.style.display = 'none';
    }
    
    document.getElementById('subtotal').textContent = `ETB ${Math.round(subtotal).toLocaleString()}`;
    document.getElementById('tax-amount').textContent = `ETB ${Math.round(taxAmount).toLocaleString()}`;
    document.getElementById('total-amount').textContent = `ETB ${Math.round(total).toLocaleString()}`;
}

// Handle location dropdown functionality
function handleLocationDropdowns() {
    const pickupSelect = document.getElementById('pickup_location');
    const returnSelect = document.getElementById('return_location');
    const pickupCustomDiv = document.getElementById('pickup_custom_location');
    const returnCustomDiv = document.getElementById('return_custom_location');
    const pickupCustomInput = document.getElementById('pickup_location_custom');
    const returnCustomInput = document.getElementById('return_location_custom');
    
    // Handle pickup location changes
    pickupSelect.addEventListener('change', function() {
        if (this.value === 'other') {
            pickupCustomDiv.style.display = 'block';
            pickupCustomInput.required = true;
        } else {
            pickupCustomDiv.style.display = 'none';
            pickupCustomInput.required = false;
            pickupCustomInput.value = '';
        }
        
        // Update return location "same as pickup" option text
        updateSameAsPickupOption();
    });
    
    // Handle return location changes
    returnSelect.addEventListener('change', function() {
        if (this.value === 'other') {
            returnCustomDiv.style.display = 'block';
            returnCustomInput.required = true;
        } else if (this.value === 'same_as_pickup') {
            returnCustomDiv.style.display = 'none';
            returnCustomInput.required = false;
            returnCustomInput.value = '';
            // Copy pickup location value
            copyPickupToReturn();
        } else {
            returnCustomDiv.style.display = 'none';
            returnCustomInput.required = false;
            returnCustomInput.value = '';
        }
    });
    
    // Initialize on page load
    if (pickupSelect.value === 'other') {
        pickupCustomDiv.style.display = 'block';
        pickupCustomInput.required = true;
    }
    
    if (returnSelect.value === 'other') {
        returnCustomDiv.style.display = 'block';
        returnCustomInput.required = true;
    } else if (returnSelect.value === 'same_as_pickup') {
        copyPickupToReturn();
    }
}

function updateSameAsPickupOption() {
    const pickupSelect = document.getElementById('pickup_location');
    const returnSelect = document.getElementById('return_location');
    const sameAsPickupOption = returnSelect.querySelector('option[value="same_as_pickup"]');
    
    if (sameAsPickupOption && pickupSelect.value) {
        const pickupText = pickupSelect.options[pickupSelect.selectedIndex].text;
        const isAmharic = document.documentElement.lang === 'am';
        
        if (pickupSelect.value === 'other') {
            const customInput = document.getElementById('pickup_location_custom');
            const customValue = customInput.value.trim();
            if (customValue) {
                sameAsPickupOption.textContent = isAmharic ? 
                    `ከመውሰጃ ቦታ ጋር ተመሳሳይ (${customValue})` : 
                    `Same as pickup (${customValue})`;
            } else {
                sameAsPickupOption.textContent = isAmharic ? 
                    'ከመውሰጃ ቦታ ጋር ተመሳሳይ' : 
                    'Same as pickup location';
            }
        } else if (pickupSelect.value) {
            sameAsPickupOption.textContent = isAmharic ? 
                `ከመውሰጃ ቦታ ጋር ተመሳሳይ (${pickupText})` : 
                `Same as pickup (${pickupText})`;
        } else {
            sameAsPickupOption.textContent = isAmharic ? 
                'ከመውሰጃ ቦታ ጋር ተመሳሳይ' : 
                'Same as pickup location';
        }
    }
}

function copyPickupToReturn() {
    const pickupSelect = document.getElementById('pickup_location');
    const pickupCustomInput = document.getElementById('pickup_location_custom');
    
    // Create hidden input to store the actual pickup location value for return
    let hiddenReturnInput = document.getElementById('actual_return_location');
    if (!hiddenReturnInput) {
        hiddenReturnInput = document.createElement('input');
        hiddenReturnInput.type = 'hidden';
        hiddenReturnInput.id = 'actual_return_location';
        hiddenReturnInput.name = 'actual_return_location';
        document.getElementById('booking-form').appendChild(hiddenReturnInput);
    }
    
    if (pickupSelect.value === 'other') {
        hiddenReturnInput.value = pickupCustomInput.value.trim() || pickupSelect.value;
    } else {
        hiddenReturnInput.value = pickupSelect.value;
    }
}

// Handle form submission to process custom locations
function handleFormSubmission() {
    const form = document.getElementById('booking-form');
    
    form.addEventListener('submit', function(e) {
        const pickupSelect = document.getElementById('pickup_location');
        const returnSelect = document.getElementById('return_location');
        const pickupCustomInput = document.getElementById('pickup_location_custom');
        const returnCustomInput = document.getElementById('return_location_custom');
        
        // Handle pickup location
        if (pickupSelect.value === 'other') {
            const customValue = pickupCustomInput.value.trim();
            if (!customValue) {
                e.preventDefault();
                alert(document.documentElement.lang === 'am' ? 
                    'እባክዎ የመውሰጃ ቦታ ያስገቡ' : 
                    'Please enter pickup location');
                pickupCustomInput.focus();
                return false;
            }
            // Set the select value to the custom input value for form submission
            pickupSelect.value = customValue;
        }
        
        // Handle return location
        if (returnSelect.value === 'other') {
            const customValue = returnCustomInput.value.trim();
            if (!customValue) {
                e.preventDefault();
                alert(document.documentElement.lang === 'am' ? 
                    'እባክዎ የመመለሻ ቦታ ያስገቡ' : 
                    'Please enter return location');
                returnCustomInput.focus();
                return false;
            }
            // Set the select value to the custom input value for form submission
            returnSelect.value = customValue;
        } else if (returnSelect.value === 'same_as_pickup') {
            // Set return location to same as pickup
            if (pickupSelect.value === 'other') {
                returnSelect.value = pickupCustomInput.value.trim();
            } else {
                returnSelect.value = pickupSelect.value;
            }
        }
        
        return true;
    });
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    updateDates();
    updatePricing();
    handleLocationDropdowns();
    handleFormSubmission();
    
    // Update "same as pickup" option when pickup custom input changes
    const pickupCustomInput = document.getElementById('pickup_location_custom');
    if (pickupCustomInput) {
        pickupCustomInput.addEventListener('input', updateSameAsPickupOption);
    }
});
</script>
@endsection
