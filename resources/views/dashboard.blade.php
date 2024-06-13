<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="color: #edd29b;">
            {{ __('Dashboard') }}
        </h2> --}}
    </x-slot>
    <section id="content2">
        <div class="container px-5">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-4 order-lg-2">
                    <div class="p-4">
                        <img class="img-fluid rounded-circle" src="storage/bg4.jpg" alt="..."
                        style="width: 250%; max-width: 300px; height: auto; box-shadow: 0px 0px 10px rgb(0, 0, 0);" />
                    </div>
                </div>
                <div class="col-lg-8 order-lg-1">
                    <div class="p-5">
                        <h4 class="display-4" style="color: rgb(255, 221, 126);">SELAMAT DATANG</h4>
                            <p style="text-align: justify;">
                                <span class="display-4" style="color: rgb(255, 221, 126);">BANDTIS</span> Bandung Tour Information System yakni sebuah platform web yang dirancang untuk
                                memberikan informasi lengkap mengenai pariwisata di Bandung. Website ini menyediakan fitur peta interaktif yang
                                menampilkan persebaran titik lokasi wisata di Bandung. Selain itu, BANDTIS juga memberikan informasi terkait
                                fakta-fakta unik dan menarik tentang Bandung, rekomendasi hotel untuk penginapan, dan rekomendasi kuliner. BANDTIS
                                menjadi panduan lengkap bagi wisatawan yang ingin menikmati pesona Bandung.
                            </p>
                        <a class="btn btn-xl rounded-pill mt-3" href="{{ route('index') }}"
                            style="background-color: rgb(237, 205, 116); color: rgb(9, 9, 9);">Peta Titik Wisata</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container py-12 ">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="card-title text-center">Data Titik Wisata</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-primary text-center" role="alert">
                                <h4><i class="fa-solid fa-location-dot"></i> Jumlah Titik Wisata</h4>
                                <p style=" font-size: 32pt"> {{ $total_points }}</p>
                            </div>
                        </div>
                        {{-- <div class="col">
                        <div class="alert alert-success" role="alert">
                            <h4><i class="fa-solid fa-route"></i></i> Total Polylines</h4>
                            <p style=" font-size: 32pt"> {{ $total_polylines }} </p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="alert alert-danger" role="alert">
                            <h4><i class="fa-solid fa-draw-polygon"></i></i></i> Total Polygons</h4>
                            <p style=" font-size: 32pt"> {{ $total_polygons }}</p>
                        </div>
                    </div> --}}
                    </div>
                    <hr>
                    <p class="mt-2 ">
                        Anda login sebagai <b>{{ Auth::user()->name }}</b> dengan email
                        <i> {{ Auth::user()->email }}</i>
                    </p>
                </div>
            </div>
        </div>
        <div class="container">
            <h2 class="text-center mb-4" style="color: rgb(237, 205, 116); font-size: 25px;">Fakta Menarik Bandung</h2>
            <div class="row">
                <div class="col-md-6">
                    <div id="attraction1">
                        <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top"
                            href="https://www.bandung.go.id/sejarah">
                            <img src="storage/bandung.jpeg" alt="" width="150" height="150">
                            <div class="col-lg-8" style="text-align: justify;">
                                <h6 class="mb-0">Lahirnya Konferensi Asia - Afrika</h6>
                                <small class="text-body-secondary">Kota Bandung tak bisa dilepaskan dari lahirnya
                                    Konferensi Asia-Afrika pada 1955 yang membuat Indonesia, khususnya Bandung dikenal
                                    dunia. Bukti sejarah tersebut, dapat lihat langsung di Museum Konferensi Asia-Afrika
                                    yang berada di Jalan Asia Afrika No.65, Braga, Bandung.
                                </small>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div id="attraction2">
                        <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top"
                            href="https://kumparan.com/jendela-dunia/35-tempat-wisata-kuliner-bandung-yang-wajib-dicoba-227IrkBEzvN">
                            <img src="storage/kawahp.png" alt="" width="150" height="150">
                            <div class="col-lg-8" style="text-align: justify;">
                                <h6 class="mb-0">Keindahan Alam</h6>
                                <small class="text-body-secondary">Bandung memiliki banyak destinasi wisata yang
                                    menawarkan keindahan alam yang memesona. Mulai dari wisata pegunungan, air terjun
                                    alias curug, hingga perkebunan teh yang kerap menjadi spot terbaik menikmati sunrise
                                    di Bandung</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div id="attraction3">
                        <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top"
                            href="https://kumparan.com/jendela-dunia/35-tempat-wisata-kuliner-bandung-yang-wajib-dicoba-227IrkBEzvN">
                            <img src="storage/makan.jpg" alt="" width="150" height="150">
                            <div class="col-lg-8" style="text-align: justify;">
                                <h6 class="mb-0">Pusat Kuliner Viral</h6>
                                <small class="text-body-secondary">Bandung memiliki banyak destinasi wisata yang
                                    menawarkan keindahan alam yang memesona. Mulai dari wisata pegunungan, air terjun
                                    alias curug, hingga perkebunan teh yang kerap menjadi spot terbaik menikmati sunrise
                                    di Bandung</small>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div id="attraction4">
                        <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top"
                            href="https://kumparan.com/jendela-dunia/35-tempat-wisata-kuliner-bandung-yang-wajib-dicoba-227IrkBEzvN">
                            <img src="storage/pvjj.jpg" alt="" width="150" height="150">
                            <div class="col-lg-8" style="text-align: justify;">
                                <h6 class="mb-0">Paris van Java</h6>
                                <small class="text-body-secondary">Bandung kerap disebut sebagai “Paris van Java”,
                                    salah satu alasannya karena Bandung menjadi salah satu kota yang melahirkan tren
                                    fashion terkini, yang dimulai sejak 1900-an, dan terus berkembang hingga saat
                                    ini.</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>


        <!-- Courses Start -->
        <div class="container-xxl courses my-6 py-6 pb-0 " style="margin-bottom: 30px;">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s"
                    style="max-width: 500px; color: rgb(237, 205, 116);">
                    <h1 class="display-6 mb-4" style="text-shadow: 0 0 3px rgb(255, 253, 253)">Hotel
                        Recomendations</h1>
                </div>
                <div class="row g-5 justify-content-center">
                    <div class="col-lg-3 col-md-12">
                        <div class="courses-item d-flex flex-column overflow-hidden h-100"
                            style=" border-radius: 35px; background-color: rgb(245, 227, 182);">
                            <img class="img-fluid" src="storage/gh.jpg" alt="">
                            <div class="text-center p-4 pt-0">
                                <div class="d-inline-block bg-brown text-black fs-5 py-1 px-4 mb-4">★★★★★</div>
                                <h5 class="mb-3">GH Universal Hotel</h5>
                                <p>Jl. Dr. Setiabudi No.376, Ledeng, Kec. Cidadap, Kota Bandung, Jawa Barat </p>
                                <p> Phone: (022) 2010388</p>
                            </div>
                            <div class="position-relative mt-auto">

                                <div class="courses-overlay">
                                    <a class="btn  border-2" style="background-color: #d1b88d;"
                                        href="https://ghuniversal.com/">Read
                                        More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="courses-item d-flex flex-column overflow-hidden h-100"
                            style=" border-radius: 35px; background-color: rgb(245, 227, 182);">
                            <img class="img-fluid" src="storage/papandayan.jpg" alt="">
                            <div class="text-center p-4 pt-0">
                                <div class="d-inline-block bg-brown text-black fs-5 py-1 px-4 mb-4">★★★★★</div>
                                <h5 class="mb-3">The Papandayan</h5>
                                <p>Jl. Gatot Subroto No.83, Malabar, Kec. Lengkong, Kota Bandung, Jawa Barat </p>
                                <p>Phone: (022) 7310799</p>
                            </div>
                            <div class="position-relative mt-auto">
                                <div class="courses-overlay">
                                    <a class="btn  border-2" style="background-color: #d8c097;"
                                        href="https://thepapandayan.com/">Read
                                        More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="courses-item d-flex flex-column overflow-hidden h-100"
                            style=" border-radius: 35px; background-color: rgb(245, 227, 182);">
                            <img class="img-fluid" src="storage/gaia.jpg" alt="">
                            <div class="text-center p-4 pt-0">
                                <div class="d-inline-block bg-brown text-black fs-5 py-1 px-4 mb-4">★★★★★</div>
                                <h5 class="mb-3">The Gaia Hotel Bandung</h5>
                                <p> Jl. Dr. Setiabudi No.430, Ledeng, Kec. Cidadap, Kota Bandung, Jawa Barat</p>
                                <p> Phone: (022) 20280780 </p>
                            </div>
                            <div class="position-relative mt-auto">
                                <div class="courses-overlay">
                                    <a class="btn  border-2" style="background-color: #d8c097;"
                                        href="https://thegaiabandung.com/">Read
                                        More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="courses-item d-flex flex-column overflow-hidden h-100"
                            style=" border-radius: 35px; background-color: rgb(245, 227, 182);">
                            <img class="img-fluid" src="storage/Courtyard.jpg" alt="">
                            <div class="text-center p-4 pt-0">
                                <div class="d-inline-block bg-brown text-black fs-5 py-1 px-4 mb-4">★★★★</div>
                                <h5 class="mb-3">Courtyard Bandung Dago </h5>
                                <p> Jl. Ir. H. Juanda No.33, Tamansari, Kec. Bandung Wetan, Kota Bandung, Jawa Barat
                                </p>
                                <p> Phone: (022) 4211333</p>
                            </div>
                            <div class="position-relative mt-auto">
                                <div class="courses-overlay">
                                    <a class="btn  border-2" style="background-color: #d8c097;"
                                        href="https://www.marriott.com/en-us/hotels/bdocy-courtyard-bandung-dago/overview/?gclid=CjwKCAjwjqWzBhAqEiwAQmtgT97ixi0s-Q1pVYaSyRntMf3fjJFEUKKVWoYSNqGAbFS0PxodgUVirxoCsaEQAvD_BwE&gclsrc=aw.ds&cid=PAI_GLB00050CK_GLE000BLSV_GLF000ONTP">Read
                                        More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <footer class="bg-light text-black py-4 mt-10">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h5 class="mb-1">Bandung Tour Information System</h5>
                        <ul class="list-unstyled">
                            <p>&copy; 2024 Raissa Nirbana</p>
                            <li>Email: raissanirbana1904@mail.ugm.ac.id</li>
                            <li>Instagram: @raissanrbna_</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <div class="row align-items-center"> <!-- Baris untuk gambar kotak dan teks -->
                            <div class="col"> <!-- Kolom untuk teks "Instansi" -->
                                <ul class="list-unstyled">
                                    <li>Program Studi Sistem Informasi Geografis</li>
                                    <li>Departemen Teknologi Kebumian</li>
                                    <li>Sekolah Vokasi</li>
                                    <li>Universitas Gadjah Mada</li>
                                </ul>
                            </div>
                            <div class="col-auto me-3"> <!-- Kolom untuk gambar kotak -->
                                <img src="storage/logougm.png" alt="" style="max-width: 150px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>


</x-app-layout>
