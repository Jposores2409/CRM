<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-cyan-400 text-sm text-center" :status="session('status')"/>

    <div class="flex flex-col items-center w-full max-w-md">
        <span class="text-cyan-400 text-xs tracking-[3px] uppercase border border-cyan-400/30 bg-cyan-400/10 px-4 py-1 rounded-full mb-5">
            SISTEMA CRM
        </span>
        <h1 class="text-white text-4xl font-extrabold text-center leading-tight mb-2" style="font-family: 'Syne', sans-serif;">
            Bienvenido al <br>
            <span class="text-cyan-400">Panel de Gestion</span>
        </h1>
        <p class="text-white/40 text-sm text-center mb-8">
            Acceso seguro para usuarios autorizados
        </p>
        <button
            onclick="toggleLogin()"
            class="flex items-center gap-3 border border-cyan-400/50 text-cyan-400 px-7 py-3.5 rounded-full text-sm font-medium hover:bg-cyan-400/10 hover:border-cyan-400 transition-all duration-300 hover:-translate-y-0.5">
            ¿Quieres Ingresar? Verifica tu acceso
            <span id="arrowIcon" class="w-5 h-5 border border-cyan-400 rounded-full flex items-center justify-center text-[10px] transform duration-300"></span>
        </button>
        <div id="loginPanel" class="w-full max-h-0 overflow-hidden opacity-0 transition-all duration-500 ease-in-out">
            <div class="mt-6 bg-white/5 border border-white/10 rounded-2x1 p-7 backdrop-blur-md">
                <form method="POST" action="{{route('login')}}">
                    @csrf
                    <label class="block text-[11px] tracking-widest uppercase text-white/50 mb-1.5">Correo Electrónico</label>
                    <input type="email" name="email" value="{{old('email')}}" placeholder="" class="w-full bg-white/5 border border-white/15 rounded-lg text-white text-sm px-4 py-2.5 mb-4 outline-none focus:border-cyan-400 transition-colors placeholder-white/25">
                    
                    <label class="block text-[11px] tracking-widest uppercase text-white/50 mb-1.5">Contraseña</label>
                    <input type="password" name="password" placeholder="" class="w-full bg-white/5 border border-white/15 rounded-lg text-white text-sm px-4 py-2.5 mb-5 outline-none focus:border-cyan-400 transition-colors placeholder-white/25">
                    @if ($errors->any())
                        <p class="text-red-400 text-xs mb-4">{{$errors->first()}}</p>
                    @endif
                    <button type="submit" class="w-full bg-cyan-400 text-[#0a0f1e] font-bold text-smpy-3 rounded-lg hover:opacity-85 transition-all duration-200 hover:-translate-y-05">
                        Ingresar al Sistema
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleLogin() {
            const panel1 = document.getElementById('loginPanel');
            const arrow = document.getElementById('arrowIcon');
            const isOpen = panel1.classList.contains('max-h-96');
            if (isOpen) {
                panel1.classList.replace('max-h-96', 'max-h-0');
                panel1.classList.replace('opacity-100', 'opacity-0');
                arrow.style.transform = 'rotate(0deg)';
            } else {
                panel1.classList.replace('max-h-0', 'max-h-96');
                panel1.classList.replace('opacity-0', 'opacity-100');
                arrow.style.transform = 'rotate(45deg)';
            }
        }
    </script>
</x-guest-layout>