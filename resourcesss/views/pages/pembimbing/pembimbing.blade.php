@extends('layouts.app')

@section('title', 'Pembimbing Magang')

@section('header_title', 'Daftar Pembimbing')

@section('content')
<div class="max-w-6xl mx-auto pb-10">
    
    <div class="mb-8 px-2">
        <h2 class="text-2xl font-bold text-gray-800">Pembimbing Magang Anda</h2>
        <p class="text-gray-500 mt-1">Gunakan informasi di bawah ini untuk berkonsultasi mengenai kegiatan magang atau laporan akhir.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
        
        

        <div class="bg-white border border-gray-200 rounded-[2rem] p-8 shadow-sm hover:shadow-md transition-all relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-full -mr-10 -mt-10 group-hover:bg-blue-100 transition-colors"></div>

            <div class="flex flex-col items-center text-center relative z-10">
                <div class="w-32 h-32 rounded-full border-4 border-tsu-blue p-1 mb-4">
                    <img src="https://ui-avatars.com/api/?name=Keguh+Tusyanto&background=00537c&color=fff&size=128" alt="Foto Mentor" class="w-full h-full rounded-full object-cover">
                </div>
                <span class="bg-blue-50 text-tsu-blue px-4 py-1 rounded-full text-xs font-bold uppercase tracking-widest mb-2">Mentor Lapangan</span>
                <h3 class="text-xl font-black text-gray-800">Kuriman Tech S.Kom, M.Kom.</h3>
                <p class="text-gray-500 text-sm mb-6">NIDN. 123456789</p>

                <div class="w-full space-y-3">
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                        <span class="text-gray-500 text-sm">Email</span>
                        <span class="text-gray-800 font-medium text-sm">kurimantech@gmail.com</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                        <span class="text-gray-500 text-sm">WhatsApp</span>
                        <span class="text-gray-800 font-medium text-sm">+62 812-3456-XXXX</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                        <span class="text-gray-500 text-sm">Perusahaan</span>
                        <span class="text-gray-800 font-medium text-sm">Bangkit Academy</span>
                    </div>
                </div>

                <a href="mailto:thomassatriabintara31@gmail.com?subject=Konsultasi%20Magang%20-%20Thomas%20gtg" 
                class="mt-8 w-full bg-tsu-teal text-white py-3 rounded-2xl font-bold hover:bg-teal-700 transition flex items-center justify-center gap-2 shadow-lg shadow-teal-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Kirim Email
                </a>

                <a href="https://wa.me/6282146268107" target="_blank" class="mt-8 w-full bg-tsu-blue text-white py-3 rounded-2xl font-bold hover:bg-opacity-90 transition flex items-center justify-center gap-2 shadow-lg shadow-blue-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                    </svg>
                    Hubungi via WhatsApp
                </a>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-[2rem] p-8 shadow-sm hover:shadow-md transition-all relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-teal-50 rounded-bl-full -mr-10 -mt-10 group-hover:bg-teal-100 transition-colors"></div>
            
            <div class="flex flex-col items-center text-center relative z-10">
                <div class="w-32 h-32 rounded-full border-4 border-tsu-teal p-1 mb-4">
                    <img src="https://ui-avatars.com/api/?name=Wawan+Laksito&background=0d9488&color=fff&size=128" alt="Foto Dosen" class="w-full h-full rounded-full object-cover">
                </div>
                <span class="bg-teal-50 text-tsu-teal px-4 py-1 rounded-full text-xs font-bold uppercase tracking-widest mb-2">Dosen Pembimbing</span>
                <h3 class="text-xl font-black text-gray-800">Wawan Laksito, S.Kom, M.M</h3>
                <p class="text-gray-500 text-sm mb-6">NIDN: 062105XXXXX</p>
                
                <div class="w-full space-y-3">
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                        <span class="text-gray-500 text-sm">Email</span>
                        <span class="text-gray-800 font-medium text-sm">wawan@staff.tsu.ac.id</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                        <span class="text-gray-500 text-sm">WhatsApp</span>
                        <span class="text-gray-800 font-medium text-sm">+62 812-3456-XXXX</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                        <span class="text-gray-500 text-sm">Instansi</span>
                        <span class="text-gray-800 font-medium text-sm">PT. Tiga Serangkai</span>
                    </div>
                </div>

                <a href="mailto:22430035.thomas@tsu.ac.id?subject=Bimbingan%20Magang%20-%20Thomas%20gtg" 
                class="mt-8 w-full bg-tsu-teal text-white py-3 rounded-2xl font-bold hover:bg-teal-700 transition flex items-center justify-center gap-2 shadow-lg shadow-teal-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Kirim Email
                </a>

                <a href="https://wa.me/6282146268107" target="_blank" class="mt-8 w-full bg-tsu-blue text-white py-3 rounded-2xl font-bold hover:bg-opacity-90 transition flex items-center justify-center gap-2 shadow-lg shadow-blue-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                    </svg>
                    Hubungi via WhatsApp
                </a>
            </div>
        </div>
    </div>

    <div class="bg-tsu-teal/5 border border-tsu-teal/10 rounded-3xl p-8">
        <div class="flex flex-col md:flex-row items-center gap-6">
            <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-tsu-teal" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <h4 class="text-lg font-bold text-gray-800">Butuh Konsultasi Lebih Lanjut?</h4>
                <p class="text-gray-600 text-sm">Pastikan untuk membuat janji temu minimal 1 hari sebelum melakukan konsultasi tatap muka dengan Dosen Pembimbing maupun Mentor Lapangan.</p>
            </div>
        </div>
    </div>
</div>
@endsection