/**
 * SkyBook Flight Booking Platform - Zero-Database State Engine & Application
 */

// --- SEED DATA DEFINITIONS ---
const INITIAL_AIRPORTS = [
    { code: 'PNH', name: 'Techo International Airport', city: 'Phnom Penh', country: 'Cambodia', flag: '🇰🇭' },
    { code: 'SAI', name: 'Siem Reap Angkor International Airport', city: 'Siem Reap', country: 'Cambodia', flag: '🇰🇭' },
    { code: 'SIN', name: 'Singapore Changi Airport', city: 'Singapore', country: 'Singapore', flag: '🇸🇬' },
    { code: 'BKK', name: 'Suvarnabhumi Airport', city: 'Bangkok', country: 'Thailand', flag: '🇹🇭' },
    { code: 'KUL', name: 'Kuala Lumpur International Airport', city: 'Kuala Lumpur', country: 'Malaysia', flag: '🇲🇾' },
    { code: 'SGN', name: 'Tan Son Nhat International Airport', city: 'Ho Chi Minh City', country: 'Vietnam', flag: '🇻🇳' },
    { code: 'HND', name: 'Tokyo Haneda Airport', city: 'Tokyo', country: 'Japan', flag: '🇯🇵' },
    { code: 'ICN', name: 'Incheon International Airport', city: 'Seoul', country: 'South Korea', flag: '🇰🇷' },
    { code: 'DXB', name: 'Dubai International Airport', city: 'Dubai', country: 'United Arab Emirates', flag: '🇦🇪' },
    { code: 'LHR', name: 'London Heathrow Airport', city: 'London', country: 'United Kingdom', flag: '🇬🇧' },
    { code: 'CDG', name: 'Paris Charles de Gaulle Airport', city: 'Paris', country: 'France', flag: '🇫🇷' },
    { code: 'JFK', name: 'John F. Kennedy International Airport', city: 'New York', country: 'United States', flag: '🇺🇸' },
    { code: 'LAX', name: 'Los Angeles International Airport', city: 'Los Angeles', country: 'United States', flag: '🇺🇸' },
    { code: 'SYD', name: 'Sydney Kingsford Smith Airport', city: 'Sydney', country: 'Australia', flag: '🇦🇺' }
];

const INITIAL_AIRLINES = [
    { id: 1, code: 'SQ', name: 'Singapore Airlines', rating: 4.9, logoColor: 'bg-amber-600', alliance: 'Star Alliance' },
    { id: 2, code: 'QR', name: 'Qatar Airways', rating: 4.9, logoColor: 'bg-rose-900', alliance: 'oneworld' },
    { id: 3, code: 'EK', name: 'Emirates', rating: 4.8, logoColor: 'bg-red-600', alliance: 'Emirates Group' },
    { id: 4, code: 'K6', name: 'Cambodia Angkor Air', rating: 4.6, logoColor: 'bg-indigo-600', alliance: 'National Carrier' },
    { id: 5, code: 'NH', name: 'ANA All Nippon Airways', rating: 4.8, logoColor: 'bg-blue-600', alliance: 'Star Alliance' },
    { id: 6, code: 'AF', name: 'Air France', rating: 4.7, logoColor: 'bg-blue-900', alliance: 'SkyTeam' },
    { id: 7, code: 'CX', name: 'Cathay Pacific', rating: 4.8, logoColor: 'bg-emerald-700', alliance: 'oneworld' },
    { id: 8, code: 'DL', name: 'Delta Air Lines', rating: 4.7, logoColor: 'bg-sky-800', alliance: 'SkyTeam' }
];

const INITIAL_AIRCRAFT = [
    { id: 1, model: 'Boeing 787-9 Dreamliner', capacity: 290, seatLayout: '3-3-3', range: '14,140 km' },
    { id: 2, model: 'Airbus A350-900', capacity: 325, seatLayout: '3-3-3', range: '15,000 km' },
    { id: 3, model: 'Boeing 777-300ER', capacity: 368, seatLayout: '3-4-3', range: '13,650 km' },
    { id: 4, model: 'Airbus A321neo', capacity: 196, seatLayout: '3-3', range: '7,400 km' }
];

// Helper to generate dates around today
function getDateOffset(days) {
    const d = new Date();
    d.setDate(d.getDate() + days);
    return d.toISOString().split('T')[0];
}

const INITIAL_FLIGHTS = [
    {
        id: 'FL-101',
        flightNumber: 'SQ-158',
        airlineId: 1,
        aircraftId: 1,
        origin: 'PNH',
        destination: 'SIN',
        departureDate: getDateOffset(1),
        departureTime: '09:40',
        arrivalDate: getDateOffset(1),
        arrivalTime: '12:45',
        duration: '2h 05m',
        durationMinutes: 125,
        stops: 0,
        stopDetails: 'Non-stop',
        price: 185,
        businessPrice: 520,
        firstPrice: 980,
        availableSeats: 48,
        totalSeats: 290,
        baggage: '30kg Included',
        cabin: 'Economy',
        status: 'On Time'
    },
    {
        id: 'FL-102',
        flightNumber: 'QR-962',
        airlineId: 2,
        aircraftId: 2,
        origin: 'PNH',
        destination: 'DXB',
        departureDate: getDateOffset(1),
        departureTime: '14:20',
        arrivalDate: getDateOffset(1),
        arrivalTime: '21:30',
        duration: '10h 10m',
        durationMinutes: 610,
        stops: 1,
        stopDetails: '1 Stop via DOH',
        price: 495,
        businessPrice: 1450,
        firstPrice: 2800,
        availableSeats: 24,
        totalSeats: 325,
        baggage: '35kg Included',
        cabin: 'Economy',
        status: 'On Time'
    },
    {
        id: 'FL-103',
        flightNumber: 'K6-812',
        airlineId: 4,
        aircraftId: 4,
        origin: 'PNH',
        destination: 'BKK',
        departureDate: getDateOffset(1),
        departureTime: '11:15',
        arrivalDate: getDateOffset(1),
        arrivalTime: '12:30',
        duration: '1h 15m',
        durationMinutes: 75,
        stops: 0,
        stopDetails: 'Non-stop',
        price: 95,
        businessPrice: 280,
        firstPrice: 450,
        availableSeats: 32,
        totalSeats: 196,
        baggage: '20kg Included',
        cabin: 'Economy',
        status: 'Scheduled'
    },
    {
        id: 'FL-104',
        flightNumber: 'NH-878',
        airlineId: 5,
        aircraftId: 1,
        origin: 'PNH',
        destination: 'HND',
        departureDate: getDateOffset(2),
        departureTime: '22:50',
        arrivalDate: getDateOffset(3),
        arrivalTime: '06:45',
        duration: '5h 55m',
        durationMinutes: 355,
        stops: 0,
        stopDetails: 'Non-stop',
        price: 360,
        businessPrice: 1120,
        firstPrice: 2200,
        availableSeats: 19,
        totalSeats: 290,
        baggage: '2x 23kg',
        cabin: 'Economy',
        status: 'On Time'
    },
    {
        id: 'FL-105',
        flightNumber: 'SQ-322',
        airlineId: 1,
        aircraftId: 3,
        origin: 'SIN',
        destination: 'LHR',
        departureDate: getDateOffset(2),
        departureTime: '23:30',
        arrivalDate: getDateOffset(3),
        arrivalTime: '05:55',
        duration: '13h 25m',
        durationMinutes: 805,
        stops: 0,
        stopDetails: 'Non-stop',
        price: 740,
        businessPrice: 2650,
        firstPrice: 5100,
        availableSeats: 14,
        totalSeats: 368,
        baggage: '30kg Included',
        cabin: 'Economy',
        status: 'On Time'
    },
    {
        id: 'FL-106',
        flightNumber: 'EK-414',
        airlineId: 3,
        aircraftId: 3,
        origin: 'DXB',
        destination: 'SYD',
        departureDate: getDateOffset(2),
        departureTime: '02:15',
        arrivalDate: getDateOffset(2),
        arrivalTime: '22:05',
        duration: '13h 50m',
        durationMinutes: 830,
        stops: 0,
        stopDetails: 'Non-stop',
        price: 890,
        businessPrice: 3100,
        firstPrice: 6200,
        availableSeats: 8,
        totalSeats: 368,
        baggage: '35kg Included',
        cabin: 'Economy',
        status: 'On Time'
    },
    {
        id: 'FL-107',
        flightNumber: 'AF-257',
        airlineId: 6,
        aircraftId: 2,
        origin: 'SIN',
        destination: 'CDG',
        departureDate: getDateOffset(3),
        departureTime: '22:15',
        arrivalDate: getDateOffset(4),
        arrivalTime: '06:10',
        duration: '13h 55m',
        durationMinutes: 835,
        stops: 0,
        stopDetails: 'Non-stop',
        price: 680,
        businessPrice: 2400,
        firstPrice: 4800,
        availableSeats: 22,
        totalSeats: 325,
        baggage: '23kg Included',
        cabin: 'Economy',
        status: 'Scheduled'
    },
    {
        id: 'FL-108',
        flightNumber: 'DL-168',
        airlineId: 8,
        aircraftId: 1,
        origin: 'HND',
        destination: 'LAX',
        departureDate: getDateOffset(3),
        departureTime: '16:50',
        arrivalDate: getDateOffset(3),
        arrivalTime: '10:45',
        duration: '9h 55m',
        durationMinutes: 595,
        stops: 0,
        stopDetails: 'Non-stop',
        price: 610,
        businessPrice: 2150,
        firstPrice: 4100,
        availableSeats: 15,
        totalSeats: 290,
        baggage: '2x 23kg',
        cabin: 'Economy',
        status: 'On Time'
    },
    {
        id: 'FL-109',
        flightNumber: 'CX-600',
        airlineId: 7,
        aircraftId: 4,
        origin: 'PNH',
        destination: 'ICN',
        departureDate: getDateOffset(2),
        departureTime: '08:10',
        arrivalDate: getDateOffset(2),
        arrivalTime: '17:35',
        duration: '7h 25m',
        durationMinutes: 445,
        stops: 1,
        stopDetails: '1 Stop via HKG',
        price: 340,
        businessPrice: 980,
        firstPrice: 1750,
        availableSeats: 29,
        totalSeats: 196,
        baggage: '30kg Included',
        cabin: 'Economy',
        status: 'On Time'
    },
    {
        id: 'FL-110',
        flightNumber: 'SQ-024',
        airlineId: 1,
        aircraftId: 2,
        origin: 'SIN',
        destination: 'JFK',
        departureDate: getDateOffset(4),
        departureTime: '11:35',
        arrivalDate: getDateOffset(4),
        arrivalTime: '19:40',
        duration: '18h 05m',
        durationMinutes: 1085,
        stops: 0,
        stopDetails: 'World Longest Flight',
        price: 1180,
        businessPrice: 3850,
        firstPrice: 7900,
        availableSeats: 6,
        totalSeats: 325,
        baggage: '2x 32kg',
        cabin: 'Economy',
        status: 'On Time'
    },
    {
        id: 'FL-111',
        flightNumber: 'K6-105',
        airlineId: 4,
        aircraftId: 4,
        origin: 'PNH',
        destination: 'SAI',
        departureDate: getDateOffset(1),
        departureTime: '07:30',
        arrivalDate: getDateOffset(1),
        arrivalTime: '08:20',
        duration: '50m',
        durationMinutes: 50,
        stops: 0,
        stopDetails: 'Non-stop',
        price: 65,
        businessPrice: 150,
        firstPrice: 220,
        availableSeats: 45,
        totalSeats: 196,
        baggage: '20kg Included',
        cabin: 'Economy',
        status: 'On Time'
    },
    {
        id: 'FL-112',
        flightNumber: 'EK-384',
        airlineId: 3,
        aircraftId: 3,
        origin: 'BKK',
        destination: 'DXB',
        departureDate: getDateOffset(2),
        departureTime: '01:40',
        arrivalDate: getDateOffset(2),
        arrivalTime: '05:20',
        duration: '6h 40m',
        durationMinutes: 400,
        stops: 0,
        stopDetails: 'Non-stop',
        price: 430,
        businessPrice: 1350,
        firstPrice: 2600,
        availableSeats: 30,
        totalSeats: 368,
        baggage: '30kg Included',
        cabin: 'Economy',
        status: 'On Time'
    }
];

const INITIAL_BOOKINGS = [
    {
        id: 'BK-78921',
        bookingReference: 'SB-78921',
        flightId: 'FL-101',
        passengerName: 'Alex Morgan',
        passengerEmail: 'alex.morgan@example.com',
        passengerPhone: '+1 (555) 349-8821',
        passportNumber: 'N84920188',
        nationality: 'United States',
        seatNumber: '4A',
        cabinClass: 'Business',
        totalPrice: 520,
        status: 'Confirmed',
        bookedAt: new Date(Date.now() - 86400000 * 2).toISOString(),
        paymentMethod: 'Visa •••• 4242',
        gate: 'B07',
        terminal: 'T2',
        boardingTime: '08:55'
    },
    {
        id: 'BK-65412',
        bookingReference: 'SB-65412',
        flightId: 'FL-103',
        passengerName: 'Alex Morgan',
        passengerEmail: 'alex.morgan@example.com',
        passengerPhone: '+1 (555) 349-8821',
        passportNumber: 'N84920188',
        nationality: 'United States',
        seatNumber: '12F',
        cabinClass: 'Economy',
        totalPrice: 95,
        status: 'Completed',
        bookedAt: new Date(Date.now() - 86400000 * 14).toISOString(),
        paymentMethod: 'Mastercard •••• 8812',
        gate: 'A03',
        terminal: 'T1',
        boardingTime: '10:35'
    }
];

// --- APP STATE ENGINE ---
class AppState {
    constructor() {
        this.storageKey = 'skybook_store_v1';
        this.loadState();
        this.currentUser = {
            role: 'customer', // 'customer' | 'admin' | 'guest'
            name: 'Alex Morgan',
            email: 'alex.morgan@example.com',
            phone: '+1 (555) 349-8821',
            tier: 'Platinum Member',
            miles: 48520
        };
        this.currentView = 'home';
        this.activeBookingFlight = null;
        this.selectedSeat = '14B';
        this.selectedCabin = 'Economy';
        this.selectedPrice = 0;
    }

    loadState() {
        const saved = localStorage.getItem(this.storageKey);
        if (saved) {
            try {
                const parsed = JSON.parse(saved);
                this.airports = parsed.airports || INITIAL_AIRPORTS;
                this.airlines = parsed.airlines || INITIAL_AIRLINES;
                this.aircraft = parsed.aircraft || INITIAL_AIRCRAFT;
                this.flights = parsed.flights || INITIAL_FLIGHTS;
                this.bookings = parsed.bookings || INITIAL_BOOKINGS;
                return;
            } catch (e) {
                console.warn('Failed to parse saved state, resetting to initial', e);
            }
        }
        this.resetToDefaults();
    }

    saveState() {
        const data = {
            airports: this.airports,
            airlines: this.airlines,
            aircraft: this.aircraft,
            flights: this.flights,
            bookings: this.bookings
        };
        localStorage.setItem(this.storageKey, JSON.stringify(data));
    }

    resetToDefaults() {
        this.airports = [...INITIAL_AIRPORTS];
        this.airlines = [...INITIAL_AIRLINES];
        this.aircraft = [...INITIAL_AIRCRAFT];
        this.flights = JSON.parse(JSON.stringify(INITIAL_FLIGHTS));
        this.bookings = JSON.parse(JSON.stringify(INITIAL_BOOKINGS));
        this.saveState();
    }

    getAirport(code) {
        return this.airports.find(a => a.code === code) || { code, city: code, name: code, country: '' };
    }

    getAirline(id) {
        return this.airlines.find(a => a.id === Number(id)) || { name: 'Aviation Partner', code: 'XX', logoColor: 'bg-blue-600' };
    }

    getFlight(id) {
        return this.flights.find(f => f.id === id || f.flightNumber === id);
    }

    getAircraft(id) {
        return this.aircraft.find(a => a.id === Number(id)) || { model: 'Airbus A350', capacity: 300 };
    }

    addBooking(bookingData) {
        this.bookings.unshift(bookingData);
        // Decrease flight seat count
        const flight = this.getFlight(bookingData.flightId);
        if (flight && flight.availableSeats > 0) {
            flight.availableSeats -= 1;
        }
        this.saveState();
    }

    cancelBooking(bookingId) {
        const bk = this.bookings.find(b => b.id === bookingId || b.bookingReference === bookingId);
        if (bk) {
            bk.status = 'Cancelled';
            const flight = this.getFlight(bk.flightId);
            if (flight) flight.availableSeats += 1;
            this.saveState();
            return true;
        }
        return false;
    }

    addFlight(flightData) {
        this.flights.unshift(flightData);
        this.saveState();
    }

    deleteFlight(flightId) {
        this.flights = this.flights.filter(f => f.id !== flightId);
        this.saveState();
    }
}

// Global instance
const store = new AppState();

// --- UI CONTROLLER & VIEW ROUTER ---
const UI = {
    init() {
        this.initEventListeners();
        this.populateDropdowns();
        this.updateAuthUI();
        this.renderHome();
        this.renderPopularDestinations();
        lucide.createIcons();
    },

    navigate(viewName, params = {}) {
        store.currentView = viewName;
        window.scrollTo({ top: 0, behavior: 'smooth' });

        // Hide all views
        document.querySelectorAll('.view-section').forEach(el => el.classList.add('hidden'));

        // Update active nav link styles
        document.querySelectorAll('.nav-link').forEach(link => {
            if (link.dataset.view === viewName) {
                link.classList.add('bg-blue-600/20', 'text-sky-400', 'border', 'border-sky-500/30');
                link.classList.remove('text-slate-300');
            } else {
                link.classList.remove('bg-blue-600/20', 'text-sky-400', 'border', 'border-sky-500/30');
                link.classList.add('text-slate-300');
            }
        });

        // Close mobile menu if open
        const mobileMenu = document.getElementById('mobile-menu');
        if (mobileMenu) mobileMenu.classList.add('hidden');

        // Show target view
        switch (viewName) {
            case 'home':
                document.getElementById('view-home').classList.remove('hidden');
                this.renderHome();
                break;
            case 'flights':
                document.getElementById('view-flights').classList.remove('hidden');
                this.renderFlightSearch(params);
                break;
            case 'bookings':
                document.getElementById('view-bookings').classList.remove('hidden');
                this.renderMyBookings();
                break;
            case 'dashboard':
                document.getElementById('view-dashboard').classList.remove('hidden');
                this.renderDashboard();
                break;
            case 'admin':
                document.getElementById('view-admin').classList.remove('hidden');
                this.renderAdmin();
                break;
            default:
                document.getElementById('view-home').classList.remove('hidden');
        }

        lucide.createIcons();
    },

    setRole(role) {
        store.currentUser.role = role;
        if (role === 'admin') {
            store.currentUser.name = 'Admin System';
            store.currentUser.email = 'admin@skybook.com';
        } else if (role === 'customer') {
            store.currentUser.name = 'Alex Morgan';
            store.currentUser.email = 'alex.morgan@example.com';
        } else {
            store.currentUser.name = 'Guest Visitor';
            store.currentUser.email = '';
        }
        this.updateAuthUI();
        this.showToast(`Switched active mode to: ${role.toUpperCase()}`, 'info');

        // Re-render current view to adapt
        this.navigate(store.currentView);
    },

    updateAuthUI() {
        const user = store.currentUser;
        const authContainer = document.getElementById('nav-user-container');
        const roleBadge = document.getElementById('active-role-indicator');
        const adminNavBtn = document.getElementById('nav-admin-link');

        if (roleBadge) {
            roleBadge.textContent = user.role.toUpperCase();
            if (user.role === 'admin') {
                roleBadge.className = 'px-2 py-0.5 rounded-full text-[10px] font-extrabold tracking-wider bg-amber-500/20 text-amber-300 border border-amber-500/40';
            } else if (user.role === 'customer') {
                roleBadge.className = 'px-2 py-0.5 rounded-full text-[10px] font-extrabold tracking-wider bg-blue-500/20 text-sky-300 border border-sky-500/40';
            } else {
                roleBadge.className = 'px-2 py-0.5 rounded-full text-[10px] font-extrabold tracking-wider bg-slate-500/20 text-slate-300 border border-slate-500/40';
            }
        }

        if (adminNavBtn) {
            adminNavBtn.classList.toggle('hidden', user.role !== 'admin');
        }

        if (authContainer) {
            authContainer.innerHTML = `
                <div class="flex items-center gap-3">
                    <button onclick="UI.toggleRoleMenu()" class="flex items-center gap-2.5 px-3 py-1.5 rounded-2xl bg-slate-800/90 border border-slate-700 hover:border-slate-500 transition-all text-left">
                        <div class="w-8 h-8 rounded-xl bg-gradient-to-tr ${user.role === 'admin' ? 'from-amber-600 to-yellow-400' : 'from-blue-600 to-sky-400'} text-white font-black flex items-center justify-center text-xs shadow-md">
                            ${user.name.split(' ').map(n => n[0]).join('').slice(0, 2)}
                        </div>
                        <div class="hidden lg:block leading-tight">
                            <span class="block text-xs font-bold text-slate-100">${user.name}</span>
                            <span class="block text-[10px] font-medium text-slate-400 capitalize">${user.role} (Click to Switch)</span>
                        </div>
                        <i data-lucide="chevron-down" class="w-3.5 h-3.5 text-slate-400"></i>
                    </button>
                </div>
            `;
        }
    },

    toggleRoleMenu() {
        const modal = document.getElementById('role-switcher-modal');
        if (modal) modal.classList.toggle('hidden');
    },

    populateDropdowns() {
        const originSelects = document.querySelectorAll('.select-origin');
        const destSelects = document.querySelectorAll('.select-destination');

        const airportOptions = store.airports.map(a => 
            `<option value="${a.code}">${a.city} (${a.code}) - ${a.name}</option>`
        ).join('');

        originSelects.forEach(sel => {
            sel.innerHTML = `<option value="">Any Origin Airport</option>` + airportOptions;
        });

        destSelects.forEach(sel => {
            sel.innerHTML = `<option value="">Any Destination Airport</option>` + airportOptions;
        });
    },

    renderHome() {
        const statsEl = document.getElementById('home-stats-counter');
        if (statsEl) {
            statsEl.innerHTML = `
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-4xl mx-auto text-center mt-12">
                    <div class="p-4 rounded-2xl bg-slate-800/60 border border-slate-700/60 backdrop-blur">
                        <div class="text-3xl font-black text-white">${store.flights.length}+</div>
                        <div class="text-xs font-semibold text-slate-400 uppercase tracking-wider mt-1">Active Routes</div>
                    </div>
                    <div class="p-4 rounded-2xl bg-slate-800/60 border border-slate-700/60 backdrop-blur">
                        <div class="text-3xl font-black text-sky-400">${store.airports.length}</div>
                        <div class="text-xs font-semibold text-slate-400 uppercase tracking-wider mt-1">Global Hubs</div>
                    </div>
                    <div class="p-4 rounded-2xl bg-slate-800/60 border border-slate-700/60 backdrop-blur">
                        <div class="text-3xl font-black text-amber-400">${store.airlines.length}</div>
                        <div class="text-xs font-semibold text-slate-400 uppercase tracking-wider mt-1">Premier Airlines</div>
                    </div>
                    <div class="p-4 rounded-2xl bg-slate-800/60 border border-slate-700/60 backdrop-blur">
                        <div class="text-3xl font-black text-emerald-400">99.8%</div>
                        <div class="text-xs font-semibold text-slate-400 uppercase tracking-wider mt-1">On-Time Index</div>
                    </div>
                </div>
            `;
        }
    },

    renderPopularDestinations() {
        const destContainer = document.getElementById('popular-destinations-grid');
        if (!destContainer) return;

        const highlights = [
            { city: 'Singapore', code: 'SIN', country: 'Singapore', price: 185, image: '🇸🇬 Changi Global Hub', desc: 'World-renowned transit hub with lush gardens & luxury terminals.' },
            { city: 'Tokyo', code: 'HND', country: 'Japan', price: 360, image: '🇯🇵 Haneda Airport', desc: 'Gateway to modern metropolis, cuisine, and neon skylines.' },
            { city: 'Dubai', code: 'DXB', country: 'UAE', price: 495, image: '🇦🇪 Emirates Gateway', desc: 'Ultra-luxury shopping, futuristic architecture and global nexus.' },
            { city: 'London', code: 'LHR', country: 'United Kingdom', price: 740, image: '🇬🇧 Heathrow Airport', desc: 'Historic European capital connecting transatlantic corridors.' }
        ];

        destContainer.innerHTML = highlights.map(h => `
            <div class="group relative rounded-3xl overflow-hidden bg-white border border-slate-200/80 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-1.5 flex flex-col justify-between">
                <div class="p-6 pb-4">
                    <div class="flex items-center justify-between mb-3">
                        <span class="px-3 py-1 rounded-full text-xs font-black bg-blue-50 text-blue-600 border border-blue-100">${h.code}</span>
                        <div class="text-right">
                            <span class="text-xs font-bold text-slate-400 block">From</span>
                            <span class="text-2xl font-black text-slate-900">$${h.price}</span>
                        </div>
                    </div>
                    <h3 class="text-xl font-black text-slate-900 group-hover:text-blue-600 transition-colors">${h.city}</h3>
                    <p class="text-xs text-slate-500 font-semibold mb-3">${h.country}</p>
                    <p class="text-xs text-slate-600 leading-relaxed">${h.desc}</p>
                </div>
                <div class="p-6 pt-0">
                    <button onclick="UI.searchDestination('${h.code}')" class="w-full py-2.5 rounded-xl bg-slate-100 group-hover:bg-blue-600 group-hover:text-white text-slate-700 font-bold text-xs transition-all flex items-center justify-center gap-2">
                        <span>Find Flights to ${h.city}</span>
                        <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                    </button>
                </div>
            </div>
        `).join('');
    },

    searchDestination(destCode) {
        this.navigate('flights', { destination: destCode });
    },

    // --- FLIGHT SEARCH & FILTER ENGINE ---
    renderFlightSearch(filters = {}) {
        // Set search form fields if provided
        if (filters.origin) {
            const originEl = document.getElementById('search-filter-origin');
            if (originEl) originEl.value = filters.origin;
        }
        if (filters.destination) {
            const destEl = document.getElementById('search-filter-destination');
            if (destEl) destEl.value = filters.destination;
        }

        this.applyFlightFilters();
    },

    applyFlightFilters() {
        const origin = document.getElementById('search-filter-origin')?.value || '';
        const destination = document.getElementById('search-filter-destination')?.value || '';
        const maxPrice = Number(document.getElementById('search-filter-price')?.value || 2000);
        const stopsFilter = document.querySelector('input[name="filter-stops"]:checked')?.value || 'all';
        const sortMode = document.getElementById('search-sort-by')?.value || 'price-asc';

        // Get selected airlines
        const selectedAirlines = Array.from(document.querySelectorAll('.airline-checkbox:checked')).map(cb => Number(cb.value));

        // Filter flights
        let results = store.flights.filter(flight => {
            if (origin && flight.origin !== origin) return false;
            if (destination && flight.destination !== destination) return false;
            if (flight.price > maxPrice) return false;
            if (stopsFilter === 'direct' && flight.stops !== 0) return false;
            if (stopsFilter === 'stops' && flight.stops === 0) return false;
            if (selectedAirlines.length > 0 && !selectedAirlines.includes(flight.airlineId)) return false;
            return true;
        });

        // Sort results
        if (sortMode === 'price-asc') results.sort((a, b) => a.price - b.price);
        if (sortMode === 'price-desc') results.sort((a, b) => b.price - a.price);
        if (sortMode === 'duration') results.sort((a, b) => a.durationMinutes - b.durationMinutes);
        if (sortMode === 'departure') results.sort((a, b) => a.departureTime.localeCompare(b.departureTime));

        // Update count badge
        const countBadge = document.getElementById('flight-results-count');
        if (countBadge) countBadge.textContent = `${results.length} Available Flights Found`;

        const priceValLabel = document.getElementById('price-range-val');
        if (priceValLabel) priceValLabel.textContent = `$${maxPrice}`;

        // Render flight cards
        const container = document.getElementById('flight-results-container');
        if (!container) return;

        if (results.length === 0) {
            container.innerHTML = `
                <div class="text-center py-16 px-6 bg-white rounded-3xl border border-slate-200 shadow-sm">
                    <div class="w-16 h-16 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="plane-off" class="w-8 h-8"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800">No flights matched your filter</h3>
                    <p class="text-sm text-slate-500 mt-1 mb-6">Try broadening your airport selection or price slider range.</p>
                    <button onclick="UI.resetSearchFilters()" class="px-6 py-2.5 bg-blue-600 text-white font-bold text-xs rounded-xl shadow hover:bg-blue-700 transition">
                        Reset All Filters
                    </button>
                </div>
            `;
            lucide.createIcons();
            return;
        }

        container.innerHTML = results.map(flight => {
            const airline = store.getAirline(flight.airlineId);
            const originAp = store.getAirport(flight.origin);
            const destAp = store.getAirport(flight.destination);

            return `
                <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-md hover:shadow-xl transition-all duration-300 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                    <!-- Left: Airline & Route Info -->
                    <div class="flex-1 space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl ${airline.logoColor} text-white font-black flex items-center justify-center text-sm shadow-sm">
                                    ${airline.code}
                                </div>
                                <div>
                                    <h4 class="text-base font-black text-slate-900 leading-tight">${airline.name}</h4>
                                    <span class="text-xs font-mono text-slate-400 font-semibold">${flight.flightNumber} • ${flight.cabin}</span>
                                </div>
                            </div>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold ${flight.stops === 0 ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-amber-50 text-amber-700 border border-amber-200'}">
                                <i data-lucide="${flight.stops === 0 ? 'check' : 'clock'}" class="w-3.5 h-3.5"></i>
                                ${flight.stopDetails}
                            </span>
                        </div>

                        <!-- Schedule Timeline -->
                        <div class="grid grid-cols-3 items-center text-center gap-2 pt-2">
                            <div class="text-left">
                                <span class="text-2xl font-black text-slate-900">${flight.departureTime}</span>
                                <span class="block text-sm font-bold text-slate-700 mt-0.5">${flight.origin}</span>
                                <span class="block text-xs text-slate-400 truncate">${originAp.city}</span>
                            </div>

                            <div class="flex flex-col items-center px-2">
                                <span class="text-[11px] font-bold text-slate-400">${flight.duration}</span>
                                <div class="w-full flex items-center gap-1.5 my-1.5">
                                    <span class="h-2 w-2 rounded-full bg-blue-600 ring-2 ring-blue-100"></span>
                                    <div class="flex-1 h-[2px] bg-slate-200 relative">
                                        <i data-lucide="plane" class="w-3.5 h-3.5 text-blue-600 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 -rotate-90"></i>
                                    </div>
                                    <span class="h-2 w-2 rounded-full bg-slate-400"></span>
                                </div>
                                <span class="text-[10px] text-slate-400 font-medium">${flight.departureDate}</span>
                            </div>

                            <div class="text-right">
                                <span class="text-2xl font-black text-slate-900">${flight.arrivalTime}</span>
                                <span class="block text-sm font-bold text-slate-700 mt-0.5">${flight.destination}</span>
                                <span class="block text-xs text-slate-400 truncate">${destAp.city}</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 text-xs text-slate-500 pt-2 border-t border-slate-100 font-medium">
                            <span class="flex items-center gap-1"><i data-lucide="luggage" class="w-3.5 h-3.5 text-slate-400"></i> ${flight.baggage}</span>
                            <span class="flex items-center gap-1"><i data-lucide="armchair" class="w-3.5 h-3.5 text-slate-400"></i> ${flight.availableSeats} seats left</span>
                            <span class="flex items-center gap-1 text-emerald-600"><i data-lucide="shield-check" class="w-3.5 h-3.5"></i> Refundable</span>
                        </div>
                    </div>

                    <!-- Right: Price & Selection -->
                    <div class="lg:w-48 flex lg:flex-col justify-between items-end lg:items-center border-t lg:border-t-0 lg:border-l border-slate-100 pt-4 lg:pt-0 lg:pl-6">
                        <div class="text-left lg:text-center">
                            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Price per Adult</span>
                            <span class="text-3xl font-black text-slate-900">$${flight.price}</span>
                            <span class="block text-[10px] text-slate-400">Taxes & fees included</span>
                        </div>
                        <button onclick="UI.openSeatModal('${flight.id}')" class="mt-3 w-full py-3 px-4 bg-gradient-to-r from-blue-600 to-sky-500 hover:from-blue-500 hover:to-sky-400 text-white font-bold text-xs rounded-2xl shadow-lg shadow-blue-600/30 hover:shadow-blue-500/50 hover:scale-[1.02] transition-all flex items-center justify-center gap-2">
                            <span>Select & Choose Seat</span>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                        </button>
                    </div>
                </div>
            `;
        }).join('');

        lucide.createIcons();
    },

    resetSearchFilters() {
        const origin = document.getElementById('search-filter-origin');
        const dest = document.getElementById('search-filter-destination');
        const price = document.getElementById('search-filter-price');
        if (origin) origin.value = '';
        if (dest) dest.value = '';
        if (price) price.value = '2000';
        document.querySelectorAll('.airline-checkbox').forEach(cb => cb.checked = false);
        const directRadio = document.querySelector('input[name="filter-stops"][value="all"]');
        if (directRadio) directRadio.checked = true;
        this.applyFlightFilters();
    },

    // --- INTERACTIVE CABIN SEAT SELECTION MODAL ---
    openSeatModal(flightId) {
        const flight = store.getFlight(flightId);
        if (!flight) return;

        store.activeBookingFlight = flight;
        store.selectedSeat = '14B';
        store.selectedCabin = 'Economy';
        store.selectedPrice = flight.price;

        const airline = store.getAirline(flight.airlineId);
        const modal = document.getElementById('seat-selector-modal');

        document.getElementById('modal-flight-summary').innerHTML = `
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl ${airline.logoColor} text-white font-black flex items-center justify-center text-xs">
                    ${airline.code}
                </div>
                <div>
                    <h4 class="text-sm font-black text-slate-900">${flight.flightNumber} — ${flight.origin} &rarr; ${flight.destination}</h4>
                    <p class="text-xs text-slate-500">${flight.departureDate} at ${flight.departureTime} • ${airline.name}</p>
                </div>
            </div>
        `;

        this.renderAirplaneSeatGrid();
        this.updateSeatSummary();
        modal.classList.remove('hidden');
        lucide.createIcons();
    },

    closeSeatModal() {
        const modal = document.getElementById('seat-selector-modal');
        if (modal) modal.classList.add('hidden');
    },

    renderAirplaneSeatGrid() {
        const container = document.getElementById('seat-map-fuselage');
        if (!container) return;

        // Seat configuration: 1-2 First, 3-5 Business, 6-18 Economy
        const rows = [
            { row: 1, type: 'first-class', priceAdd: store.activeBookingFlight.firstPrice - store.activeBookingFlight.price },
            { row: 2, type: 'first-class', priceAdd: store.activeBookingFlight.firstPrice - store.activeBookingFlight.price },
            { row: 3, type: 'business-class', priceAdd: store.activeBookingFlight.businessPrice - store.activeBookingFlight.price },
            { row: 4, type: 'business-class', priceAdd: store.activeBookingFlight.businessPrice - store.activeBookingFlight.price },
            { row: 5, type: 'business-class', priceAdd: store.activeBookingFlight.businessPrice - store.activeBookingFlight.price },
            { row: 6, type: 'economy', priceAdd: 0 },
            { row: 7, type: 'economy', priceAdd: 0 },
            { row: 8, type: 'economy', priceAdd: 0 },
            { row: 9, type: 'economy', priceAdd: 0 },
            { row: 10, type: 'economy', priceAdd: 0 },
            { row: 11, type: 'economy', priceAdd: 0 },
            { row: 12, type: 'economy', priceAdd: 0 },
            { row: 14, type: 'economy', priceAdd: 0 },
            { row: 15, type: 'economy', priceAdd: 0 },
            { row: 16, type: 'economy', priceAdd: 0 },
            { row: 17, type: 'economy', priceAdd: 0 },
            { row: 18, type: 'economy', priceAdd: 0 }
        ];

        const occupiedSeats = ['1A', '2D', '3B', '4E', '7A', '7F', '8C', '10D', '12A', '15C', '16D'];
        const colsLeft = ['A', 'B', 'C'];
        const colsRight = ['D', 'E', 'F'];

        let html = `
            <div class="airplane-nose flex items-center justify-center">
                <i data-lucide="compass" class="w-4 h-4 text-slate-400"></i>
            </div>
            <div class="airplane-fuselage p-6 max-w-md mx-auto space-y-3 bg-white">
                <div class="text-center pb-2 border-b border-slate-100">
                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-slate-400">Cockpit / Forward</span>
                </div>
        `;

        rows.forEach(r => {
            const isFirst = r.type === 'first-class';
            const isBiz = r.type === 'business-class';
            const cabinName = isFirst ? 'First Class' : (isBiz ? 'Business Class' : 'Economy');

            if (r.row === 1) {
                html += `<div class="text-center py-1 bg-amber-50 text-amber-800 text-[10px] font-bold rounded-lg uppercase tracking-wider">🌟 First Class Suites ($${store.activeBookingFlight.firstPrice})</div>`;
            } else if (r.row === 3) {
                html += `<div class="text-center py-1 bg-indigo-50 text-indigo-800 text-[10px] font-bold rounded-lg uppercase tracking-wider mt-2">💎 Business Class Cabin ($${store.activeBookingFlight.businessPrice})</div>`;
            } else if (r.row === 6) {
                html += `<div class="text-center py-1 bg-slate-100 text-slate-700 text-[10px] font-bold rounded-lg uppercase tracking-wider mt-2">✈️ Main Economy Cabin ($${store.activeBookingFlight.price})</div>`;
            }

            html += `<div class="flex items-center justify-between gap-1 py-0.5">`;

            // Left 3 seats (A, B, C)
            html += `<div class="flex items-center gap-1.5">`;
            colsLeft.forEach(col => {
                const seatCode = `${r.row}${col}`;
                const isOccupied = occupiedSeats.includes(seatCode);
                const isSelected = store.selectedSeat === seatCode;

                html += `
                    <div onclick="${isOccupied ? '' : `UI.selectSeat('${seatCode}', '${cabinName}', ${r.priceAdd})`}"
                         class="seat ${isOccupied ? 'occupied' : (isSelected ? 'selected' : (isFirst ? 'first-class' : (isBiz ? 'business-class' : 'available')))}"
                         title="${seatCode} (${cabinName})">
                        ${seatCode}
                    </div>
                `;
            });
            html += `</div>`;

            // Aisle with row number
            html += `<div class="w-6 text-center text-[10px] font-bold text-slate-300">${r.row}</div>`;

            // Right 3 seats (D, E, F)
            html += `<div class="flex items-center gap-1.5">`;
            colsRight.forEach(col => {
                const seatCode = `${r.row}${col}`;
                const isOccupied = occupiedSeats.includes(seatCode);
                const isSelected = store.selectedSeat === seatCode;

                html += `
                    <div onclick="${isOccupied ? '' : `UI.selectSeat('${seatCode}', '${cabinName}', ${r.priceAdd})`}"
                         class="seat ${isOccupied ? 'occupied' : (isSelected ? 'selected' : (isFirst ? 'first-class' : (isBiz ? 'business-class' : 'available')))}"
                         title="${seatCode} (${cabinName})">
                        ${seatCode}
                    </div>
                `;
            });
            html += `</div>`;

            html += `</div>`;
        });

        html += `
                <div class="text-center pt-2 border-t border-slate-100">
                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-slate-400">Aft Galley & Lavatories</span>
                </div>
            </div>
        `;

        container.innerHTML = html;
        lucide.createIcons();
    },

    selectSeat(seatCode, cabinName, priceAdd) {
        store.selectedSeat = seatCode;
        store.selectedCabin = cabinName;
        store.selectedPrice = store.activeBookingFlight.price + priceAdd;
        this.renderAirplaneSeatGrid();
        this.updateSeatSummary();
    },

    updateSeatSummary() {
        const flight = store.activeBookingFlight;
        if (!flight) return;

        document.getElementById('selected-seat-badge').textContent = store.selectedSeat;
        document.getElementById('selected-cabin-badge').textContent = store.selectedCabin;
        document.getElementById('selected-fare-total').textContent = `$${store.selectedPrice}`;
    },

    proceedToCheckout() {
        this.closeSeatModal();
        const checkoutModal = document.getElementById('checkout-modal');
        const flight = store.activeBookingFlight;
        const airline = store.getAirline(flight.airlineId);

        // Pre-fill user data
        document.getElementById('checkout-pass-name').value = store.currentUser.name || 'Alex Morgan';
        document.getElementById('checkout-pass-email').value = store.currentUser.email || 'alex.morgan@example.com';

        document.getElementById('checkout-fare-breakdown').innerHTML = `
            <div class="space-y-2 text-xs">
                <div class="flex justify-between text-slate-600">
                    <span>Base Flight Fare (${flight.flightNumber})</span>
                    <span>$${flight.price}.00</span>
                </div>
                <div class="flex justify-between text-slate-600">
                    <span>Cabin Upgrade (${store.selectedCabin})</span>
                    <span>+$${store.selectedPrice - flight.price}.00</span>
                </div>
                <div class="flex justify-between text-slate-600">
                    <span>Airport Security & Terminal Fee</span>
                    <span>$24.00</span>
                </div>
                <div class="flex justify-between text-slate-600">
                    <span>Selected Seat ${store.selectedSeat} Fee</span>
                    <span>Included</span>
                </div>
                <div class="pt-2 border-t border-slate-200 flex justify-between font-black text-sm text-slate-900">
                    <span>Total Amount Payable</span>
                    <span class="text-blue-600">$${store.selectedPrice + 24}.00</span>
                </div>
            </div>
        `;

        checkoutModal.classList.remove('hidden');
        lucide.createIcons();
    },

    closeCheckoutModal() {
        const modal = document.getElementById('checkout-modal');
        if (modal) modal.classList.add('hidden');
    },

    submitBooking(event) {
        event.preventDefault();
        const flight = store.activeBookingFlight;
        if (!flight) return;

        const name = document.getElementById('checkout-pass-name').value.trim();
        const email = document.getElementById('checkout-pass-email').value.trim();
        const phone = document.getElementById('checkout-pass-phone').value.trim();
        const passport = document.getElementById('checkout-pass-passport').value.trim();
        const nationality = document.getElementById('checkout-pass-nationality').value;

        if (!name || !email || !passport) {
            this.showToast('Please fill in all required passenger fields', 'error');
            return;
        }

        const refNum = 'SB-' + Math.floor(10000 + Math.random() * 90000);
        const gates = ['A02', 'B07', 'C14', 'D04', 'E09'];
        const terminals = ['T1', 'T2', 'T3'];

        const booking = {
            id: 'BK-' + Math.floor(10000 + Math.random() * 90000),
            bookingReference: refNum,
            flightId: flight.id,
            passengerName: name,
            passengerEmail: email,
            passengerPhone: phone,
            passportNumber: passport,
            nationality: nationality,
            seatNumber: store.selectedSeat,
            cabinClass: store.selectedCabin,
            totalPrice: store.selectedPrice + 24,
            status: 'Confirmed',
            bookedAt: new Date().toISOString(),
            paymentMethod: 'Visa •••• 4242',
            gate: gates[Math.floor(Math.random() * gates.length)],
            terminal: terminals[Math.floor(Math.random() * terminals.length)],
            boardingTime: this.calculateBoardingTime(flight.departureTime)
        };

        store.addBooking(booking);
        this.closeCheckoutModal();
        this.showToast(`🎉 Reservation confirmed! Ref: ${refNum}`, 'success');

        // Automatically open Boarding Pass
        this.openBoardingPassModal(booking.id);
    },

    calculateBoardingTime(departureTime) {
        const [h, m] = departureTime.split(':').map(Number);
        let totalMinutes = h * 60 + m - 45;
        if (totalMinutes < 0) totalMinutes += 1440;
        const bh = Math.floor(totalMinutes / 60);
        const bm = totalMinutes % 60;
        return `${String(bh).padStart(2, '0')}:${String(bm).padStart(2, '0')}`;
    },

    // --- BOARDING PASS MODAL ---
    openBoardingPassModal(bookingId) {
        const booking = store.bookings.find(b => b.id === bookingId || b.bookingReference === bookingId);
        if (!booking) return;

        const flight = store.getFlight(booking.flightId) || store.flights[0];
        const airline = store.getAirline(flight.airlineId);
        const originAp = store.getAirport(flight.origin);
        const destAp = store.getAirport(flight.destination);

        const container = document.getElementById('printable-boarding-pass');
        if (!container) return;

        container.innerHTML = `
            <div class="boarding-pass-card grid grid-cols-1 md:grid-cols-4 border border-slate-200">
                <!-- Left 3 cols: Main Boarding Pass -->
                <div class="md:col-span-3 p-6 sm:p-8 space-y-6">
                    <!-- Airline Top Header -->
                    <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl ${airline.logoColor} text-white font-black flex items-center justify-center text-sm shadow-sm">
                                ${airline.code}
                            </div>
                            <div>
                                <h3 class="text-lg font-black text-slate-900">${airline.name}</h3>
                                <span class="text-xs font-semibold text-slate-400">Boarding Pass & Flight Ticket</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="text-[10px] uppercase font-extrabold tracking-widest text-slate-400 block">Class</span>
                            <span class="px-3 py-1 bg-blue-50 text-blue-700 font-extrabold text-xs rounded-full border border-blue-200">${booking.cabinClass}</span>
                        </div>
                    </div>

                    <!-- Passenger & Flight Matrix -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-left">
                        <div>
                            <span class="text-[10px] uppercase font-bold text-slate-400 block">Passenger</span>
                            <span class="text-sm font-black text-slate-800 truncate block">${booking.passengerName}</span>
                        </div>
                        <div>
                            <span class="text-[10px] uppercase font-bold text-slate-400 block">Flight No.</span>
                            <span class="text-sm font-black text-blue-600">${flight.flightNumber}</span>
                        </div>
                        <div>
                            <span class="text-[10px] uppercase font-bold text-slate-400 block">Date</span>
                            <span class="text-sm font-bold text-slate-800">${flight.departureDate}</span>
                        </div>
                        <div>
                            <span class="text-[10px] uppercase font-bold text-slate-400 block">Booking Ref</span>
                            <span class="text-sm font-mono font-bold text-slate-900">${booking.bookingReference}</span>
                        </div>
                    </div>

                    <!-- Origin / Destination Route Graphic -->
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-between">
                        <div>
                            <span class="text-3xl font-black text-slate-900">${flight.origin}</span>
                            <span class="block text-xs font-bold text-slate-500">${originAp.city}</span>
                            <span class="block text-[11px] text-slate-400 mt-1">Departs ${flight.departureTime}</span>
                        </div>
                        <div class="flex flex-col items-center px-4">
                            <span class="text-[10px] font-bold text-slate-400">${flight.duration}</span>
                            <i data-lucide="plane" class="w-5 h-5 text-blue-600 my-1"></i>
                            <span class="text-[10px] font-semibold text-emerald-600">Gate Closes 15m Prior</span>
                        </div>
                        <div class="text-right">
                            <span class="text-3xl font-black text-slate-900">${flight.destination}</span>
                            <span class="block text-xs font-bold text-slate-500">${destAp.city}</span>
                            <span class="block text-[11px] text-slate-400 mt-1">Arrives ${flight.arrivalTime}</span>
                        </div>
                    </div>

                    <!-- Gate, Terminal, Seat, Boarding Time -->
                    <div class="grid grid-cols-4 gap-3 bg-blue-600 text-white rounded-2xl p-4 text-center shadow-lg shadow-blue-600/20">
                        <div>
                            <span class="text-[9px] uppercase font-bold opacity-80 block">Gate</span>
                            <span class="text-xl font-black">${booking.gate}</span>
                        </div>
                        <div>
                            <span class="text-[9px] uppercase font-bold opacity-80 block">Terminal</span>
                            <span class="text-xl font-black">${booking.terminal}</span>
                        </div>
                        <div>
                            <span class="text-[9px] uppercase font-bold opacity-80 block">Seat</span>
                            <span class="text-xl font-black text-amber-300">${booking.seatNumber}</span>
                        </div>
                        <div>
                            <span class="text-[9px] uppercase font-bold opacity-80 block">Boarding</span>
                            <span class="text-xl font-black">${booking.boardingTime}</span>
                        </div>
                    </div>

                    <!-- Simulated Barcode -->
                    <div class="pt-2">
                        <div class="barcode rounded-lg opacity-85"></div>
                        <div class="text-center font-mono text-[9px] text-slate-400 tracking-widest mt-1">ETK//${booking.bookingReference}//${flight.flightNumber}//SEAT${booking.seatNumber}</div>
                    </div>
                </div>

                <!-- Right 1 col: Stub with QR Code -->
                <div class="boarding-pass-stub md:col-span-1 p-6 bg-slate-50 flex flex-col justify-between items-center text-center space-y-4">
                    <div>
                        <span class="text-[10px] uppercase font-extrabold text-slate-400 tracking-wider">Flight Stub</span>
                        <div class="text-base font-black text-slate-900 mt-1">${flight.origin} &rarr; ${flight.destination}</div>
                        <div class="text-xs font-bold text-blue-600 mt-0.5">${flight.flightNumber}</div>
                    </div>

                    <!-- QR Code Display -->
                    <div class="p-3 bg-white rounded-2xl border border-slate-200 shadow-sm">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=SkyBook-Ticket-${booking.bookingReference}-${booking.seatNumber}" alt="Boarding Pass QR" class="w-24 h-24 rounded-lg mx-auto" />
                    </div>

                    <div class="space-y-1 w-full text-xs">
                        <div class="flex justify-between text-slate-500">
                            <span>Seat:</span>
                            <span class="font-bold text-slate-900">${booking.seatNumber}</span>
                        </div>
                        <div class="flex justify-between text-slate-500">
                            <span>Zone:</span>
                            <span class="font-bold text-slate-900">1</span>
                        </div>
                        <div class="flex justify-between text-slate-500">
                            <span>Ref:</span>
                            <span class="font-mono font-bold text-slate-900">${booking.bookingReference}</span>
                        </div>
                    </div>

                    <span class="text-[9px] text-slate-400">Keep boarding pass with you during all airport checkpoints.</span>
                </div>
            </div>
        `;

        document.getElementById('boarding-pass-modal').classList.remove('hidden');
        lucide.createIcons();
    },

    closeBoardingPassModal() {
        const modal = document.getElementById('boarding-pass-modal');
        if (modal) modal.classList.add('hidden');
    },

    printBoardingPass() {
        window.print();
    },

    // --- MY BOOKINGS VIEW ---
    renderMyBookings() {
        const container = document.getElementById('my-bookings-container');
        if (!container) return;

        const bookings = store.bookings;

        if (bookings.length === 0) {
            container.innerHTML = `
                <div class="text-center py-16 px-6 bg-white rounded-3xl border border-slate-200 shadow-sm">
                    <div class="w-16 h-16 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="ticket" class="w-8 h-8"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800">No flight reservations yet</h3>
                    <p class="text-sm text-slate-500 mt-1 mb-6">Book your first flight to view tickets, manage seats, and print boarding passes.</p>
                    <button onclick="UI.navigate('flights')" class="px-6 py-2.5 bg-blue-600 text-white font-bold text-xs rounded-xl shadow hover:bg-blue-700 transition">
                        Explore Flights
                    </button>
                </div>
            `;
            lucide.createIcons();
            return;
        }

        container.innerHTML = bookings.map(b => {
            const flight = store.getFlight(b.flightId) || store.flights[0];
            const airline = store.getAirline(flight.airlineId);
            const isCancelled = b.status === 'Cancelled';

            return `
                <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm hover:shadow-md transition-all space-y-4 ${isCancelled ? 'opacity-70 bg-slate-50' : ''}">
                    <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-100 pb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl ${airline.logoColor} text-white font-black flex items-center justify-center text-sm">
                                ${airline.code}
                            </div>
                            <div>
                                <span class="text-xs font-mono font-bold text-blue-600">${b.bookingReference}</span>
                                <h4 class="text-base font-black text-slate-900">${flight.origin} &rarr; ${flight.destination}</h4>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <span class="px-3 py-1 rounded-full text-xs font-extrabold ${b.status === 'Confirmed' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : (b.status === 'Cancelled' ? 'bg-rose-50 text-rose-700 border border-rose-200' : 'bg-slate-100 text-slate-700')}">
                                ${b.status}
                            </span>
                            <span class="text-sm font-black text-slate-900">$${b.totalPrice}</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-xs">
                        <div>
                            <span class="text-slate-400 block font-semibold">Passenger</span>
                            <span class="font-bold text-slate-800">${b.passengerName}</span>
                        </div>
                        <div>
                            <span class="text-slate-400 block font-semibold">Flight / Cabin</span>
                            <span class="font-bold text-slate-800">${flight.flightNumber} • ${b.cabinClass}</span>
                        </div>
                        <div>
                            <span class="text-slate-400 block font-semibold">Seat Number</span>
                            <span class="font-bold text-blue-600 font-mono">${b.seatNumber}</span>
                        </div>
                        <div>
                            <span class="text-slate-400 block font-semibold">Departure</span>
                            <span class="font-bold text-slate-800">${flight.departureDate} at ${flight.departureTime}</span>
                        </div>
                    </div>

                    <div class="flex flex-wrap items-center justify-end gap-3 pt-2 border-t border-slate-100">
                        ${!isCancelled ? `
                            <button onclick="UI.openBoardingPassModal('${b.id}')" class="px-4 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs shadow-sm flex items-center gap-1.5 transition">
                                <i data-lucide="printer" class="w-3.5 h-3.5"></i>
                                <span>Boarding Pass & QR</span>
                            </button>
                            <button onclick="UI.cancelBookingPrompt('${b.id}')" class="px-4 py-2 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-600 font-bold text-xs border border-rose-200 transition">
                                Cancel Booking
                            </button>
                        ` : `
                            <span class="text-xs font-semibold text-rose-500">Booking cancelled & refunded</span>
                        `}
                    </div>
                </div>
            `;
        }).join('');

        lucide.createIcons();
    },

    cancelBookingPrompt(bookingId) {
        if (confirm('Are you sure you want to cancel this flight reservation? Seats will be returned to inventory.')) {
            store.cancelBooking(bookingId);
            this.showToast('Reservation has been cancelled', 'info');
            this.renderMyBookings();
        }
    },

    // --- CUSTOMER DASHBOARD ---
    renderDashboard() {
        const user = store.currentUser;
        const totalTrips = store.bookings.filter(b => b.status !== 'Cancelled').length;
        const totalSpent = store.bookings.filter(b => b.status !== 'Cancelled').reduce((sum, b) => sum + b.totalPrice, 0);

        document.getElementById('dash-user-name').textContent = user.name;
        document.getElementById('dash-user-tier').textContent = user.tier || 'Gold Loyalty Tier';
        document.getElementById('dash-total-trips').textContent = totalTrips;
        document.getElementById('dash-miles-earned').textContent = (user.miles || 42000) + totalSpent * 10;
        document.getElementById('dash-total-spent').textContent = `$${totalSpent}`;

        // Render upcoming flights
        const upcomingContainer = document.getElementById('dash-upcoming-flights');
        const activeBookings = store.bookings.filter(b => b.status === 'Confirmed');

        if (upcomingContainer) {
            if (activeBookings.length === 0) {
                upcomingContainer.innerHTML = `
                    <div class="text-center py-8 text-slate-400 text-xs">
                        No upcoming departures scheduled. Search flights to book your next trip!
                    </div>
                `;
            } else {
                upcomingContainer.innerHTML = activeBookings.map(b => {
                    const flight = store.getFlight(b.flightId) || store.flights[0];
                    return `
                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-blue-600 text-white font-black flex items-center justify-center text-xs">
                                    <i data-lucide="plane-takeoff" class="w-4 h-4"></i>
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-slate-900">${flight.origin} &rarr; ${flight.destination} (${flight.flightNumber})</h4>
                                    <p class="text-xs text-slate-500">${flight.departureDate} • Gate ${b.gate} • Seat ${b.seatNumber}</p>
                                </div>
                            </div>
                            <button onclick="UI.openBoardingPassModal('${b.id}')" class="px-3 py-1.5 rounded-xl bg-white border border-slate-200 text-slate-800 font-bold text-xs hover:bg-slate-100 transition shadow-sm">
                                View Pass
                            </button>
                        </div>
                    `;
                }).join('');
            }
        }
        lucide.createIcons();
    },

    // --- ADMIN PANEL CONTROLLER ---
    renderAdmin() {
        const totalRevenue = store.bookings.filter(b => b.status !== 'Cancelled').reduce((sum, b) => sum + b.totalPrice, 0);
        document.getElementById('admin-stat-revenue').textContent = `$${totalRevenue.toLocaleString()}`;
        document.getElementById('admin-stat-flights').textContent = store.flights.length;
        document.getElementById('admin-stat-bookings').textContent = store.bookings.length;
        document.getElementById('admin-stat-airports').textContent = store.airports.length;

        this.renderAdminFlightsTable();
        this.renderAdminBookingsTable();
        this.renderAdminChart();
        lucide.createIcons();
    },

    renderAdminFlightsTable() {
        const tbody = document.getElementById('admin-flights-tbody');
        if (!tbody) return;

        tbody.innerHTML = store.flights.map(f => {
            const airline = store.getAirline(f.airlineId);
            return `
                <tr class="border-b border-slate-100 hover:bg-slate-50/80 transition text-xs">
                    <td class="py-3 px-4 font-mono font-bold text-blue-600">${f.flightNumber}</td>
                    <td class="py-3 px-4 font-semibold text-slate-800">${airline.name}</td>
                    <td class="py-3 px-4 font-bold text-slate-900">${f.origin} &rarr; ${f.destination}</td>
                    <td class="py-3 px-4 text-slate-600">${f.departureDate} ${f.departureTime}</td>
                    <td class="py-3 px-4 font-black text-slate-900">$${f.price}</td>
                    <td class="py-3 px-4">
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold ${f.availableSeats < 10 ? 'bg-amber-50 text-amber-700' : 'bg-emerald-50 text-emerald-700'}">
                            ${f.availableSeats} / ${f.totalSeats}
                        </span>
                    </td>
                    <td class="py-3 px-4 text-right">
                        <button onclick="UI.deleteFlightPrompt('${f.id}')" class="p-1.5 text-slate-400 hover:text-rose-600 rounded-lg hover:bg-rose-50 transition" title="Delete Flight">
                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                        </button>
                    </td>
                </tr>
            `;
        }).join('');
    },

    renderAdminBookingsTable() {
        const tbody = document.getElementById('admin-bookings-tbody');
        if (!tbody) return;

        tbody.innerHTML = store.bookings.map(b => {
            const flight = store.getFlight(b.flightId) || store.flights[0];
            return `
                <tr class="border-b border-slate-100 hover:bg-slate-50/80 transition text-xs">
                    <td class="py-3 px-4 font-mono font-bold text-slate-900">${b.bookingReference}</td>
                    <td class="py-3 px-4 font-semibold text-slate-800">${b.passengerName}</td>
                    <td class="py-3 px-4 font-bold text-blue-600">${flight.flightNumber}</td>
                    <td class="py-3 px-4 font-mono text-slate-700">${b.seatNumber} (${b.cabinClass})</td>
                    <td class="py-3 px-4 font-black text-slate-900">$${b.totalPrice}</td>
                    <td class="py-3 px-4">
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold ${b.status === 'Confirmed' ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700'}">
                            ${b.status}
                        </span>
                    </td>
                </tr>
            `;
        }).join('');
    },

    renderAdminChart() {
        const canvas = document.getElementById('admin-analytics-chart');
        if (!canvas) return;

        if (window.adminChartInstance) {
            window.adminChartInstance.destroy();
        }

        const ctx = canvas.getContext('2d');
        window.adminChartInstance = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [
                    {
                        label: 'Flight Bookings (Demo Trend)',
                        data: [14, 22, 19, 28, 35, 42, 38],
                        borderColor: '#2563eb',
                        backgroundColor: 'rgba(37, 99, 235, 0.1)',
                        fill: true,
                        tension: 0.4
                    },
                    {
                        label: 'Revenue ($ in hundreds)',
                        data: [42, 68, 55, 82, 105, 130, 118],
                        borderColor: '#10b981',
                        backgroundColor: 'transparent',
                        borderDash: [5, 5],
                        tension: 0.4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'top' }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    },

    deleteFlightPrompt(flightId) {
        if (confirm('Delete this scheduled flight from the roster?')) {
            store.deleteFlight(flightId);
            this.showToast('Flight removed successfully', 'info');
            this.renderAdmin();
        }
    },

    openAddFlightModal() {
        const modal = document.getElementById('admin-add-flight-modal');
        if (modal) modal.classList.remove('hidden');
    },

    closeAddFlightModal() {
        const modal = document.getElementById('admin-add-flight-modal');
        if (modal) modal.classList.add('hidden');
    },

    submitNewFlight(event) {
        event.preventDefault();
        const origin = document.getElementById('new-flight-origin').value;
        const dest = document.getElementById('new-flight-dest').value;
        const airlineId = Number(document.getElementById('new-flight-airline').value);
        const flightNo = document.getElementById('new-flight-number').value.trim();
        const date = document.getElementById('new-flight-date').value;
        const time = document.getElementById('new-flight-time').value;
        const price = Number(document.getElementById('new-flight-price').value);

        if (origin === dest) {
            this.showToast('Origin and Destination cannot be identical', 'error');
            return;
        }

        const newFlight = {
            id: 'FL-' + Math.floor(1000 + Math.random() * 9000),
            flightNumber: flightNo || 'SB-999',
            airlineId: airlineId || 1,
            aircraftId: 1,
            origin: origin,
            destination: dest,
            departureDate: date || getDateOffset(2),
            departureTime: time || '10:00',
            arrivalDate: date || getDateOffset(2),
            arrivalTime: '13:30',
            duration: '3h 30m',
            durationMinutes: 210,
            stops: 0,
            stopDetails: 'Non-stop',
            price: price || 199,
            businessPrice: price * 2.8,
            firstPrice: price * 5,
            availableSeats: 180,
            totalSeats: 290,
            baggage: '30kg Included',
            cabin: 'Economy',
            status: 'Scheduled'
        };

        store.addFlight(newFlight);
        this.closeAddFlightModal();
        this.showToast(`Flight ${newFlight.flightNumber} created successfully!`, 'success');
        this.renderAdmin();
    },

    resetAllData() {
        if (confirm('Reset all demo state to fresh default mock data? (Will restore all flights, bookings, and stats)')) {
            store.resetToDefaults();
            this.showToast('Demo data restored to defaults', 'success');
            this.navigate(store.currentView);
        }
    },

    // --- NOTIFICATION TOAST ---
    showToast(message, type = 'info') {
        const toast = document.getElementById('toast-notification');
        const msgEl = document.getElementById('toast-message');
        const iconEl = document.getElementById('toast-icon');

        if (!toast || !msgEl) return;

        msgEl.textContent = message;
        if (type === 'success') {
            toast.className = 'fixed bottom-6 right-6 z-50 flex items-center gap-3 px-5 py-3.5 rounded-2xl bg-emerald-900/90 text-white border border-emerald-500 shadow-2xl backdrop-blur transition-all duration-300 transform translate-y-0 opacity-100';
            iconEl.setAttribute('data-lucide', 'check-circle-2');
        } else if (type === 'error') {
            toast.className = 'fixed bottom-6 right-6 z-50 flex items-center gap-3 px-5 py-3.5 rounded-2xl bg-rose-900/90 text-white border border-rose-500 shadow-2xl backdrop-blur transition-all duration-300 transform translate-y-0 opacity-100';
            iconEl.setAttribute('data-lucide', 'alert-circle');
        } else {
            toast.className = 'fixed bottom-6 right-6 z-50 flex items-center gap-3 px-5 py-3.5 rounded-2xl bg-slate-900/90 text-white border border-slate-700 shadow-2xl backdrop-blur transition-all duration-300 transform translate-y-0 opacity-100';
            iconEl.setAttribute('data-lucide', 'info');
        }

        lucide.createIcons();

        clearTimeout(this.toastTimer);
        this.toastTimer = setTimeout(() => {
            toast.className = 'hidden';
        }, 4000);
    },

    initEventListeners() {
        // Hero quick search form
        document.getElementById('hero-search-form')?.addEventListener('submit', (e) => {
            e.preventDefault();
            const origin = document.getElementById('hero-origin').value;
            const dest = document.getElementById('hero-destination').value;
            this.navigate('flights', { origin, destination: dest });
        });

        // Price filter input
        document.getElementById('search-filter-price')?.addEventListener('input', (e) => {
            document.getElementById('price-range-val').textContent = `$${e.target.value}`;
            this.applyFlightFilters();
        });

        // Stops and sort filters
        document.querySelectorAll('input[name="filter-stops"]').forEach(r => {
            r.addEventListener('change', () => this.applyFlightFilters());
        });
        document.getElementById('search-sort-by')?.addEventListener('change', () => this.applyFlightFilters());
        document.getElementById('search-filter-origin')?.addEventListener('change', () => this.applyFlightFilters());
        document.getElementById('search-filter-destination')?.addEventListener('change', () => this.applyFlightFilters());

        // Mobile drawer toggle
        document.getElementById('mobile-menu-btn')?.addEventListener('click', () => {
            document.getElementById('mobile-menu')?.classList.toggle('hidden');
        });
    }
};

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    UI.init();
});
