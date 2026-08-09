@extends('layouts.app-flex')

@section('content')

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Blog</li>
            </ol>
            <h2>Blog</h2>
        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">

            <div class="row">

                <div class="col-lg-8 entries">

                    <article class="entry">
                        <div class="entry-img">
                            <img src="{{ asset('flex-start/img/blog/blog-1.jpg') }}" alt="" class="img-fluid">
                        </div>

                        <h2 class="entry-title">
                            <a href="{{ route('blog.show') }}">Come strutturare un progetto Laravel scalabile fin dal primo giorno</a>
                        </h2>

                        <div class="entry-meta">
                            <ul>
                                <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="{{ route('blog.show') }}">Redazione</a></li>
                                <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="{{ route('blog.show') }}"><time datetime="2026-01-15">15 Gen, 2026</time></a></li>
                                <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="{{ route('blog.show') }}">8 Commenti</a></li>
                            </ul>
                        </div>

                        <div class="entry-content">
                            <p>
                                Una buona architettura non nasce per caso: nasce da scelte consapevoli fatte prima di scrivere la prima riga di codice.
                                In questo articolo vediamo come organizzare cartelle, servizi e responsabilità in un progetto Laravel destinato a crescere nel tempo,
                                senza trasformarsi in un groviglio ingestibile.
                            </p>
                            <div class="read-more">
                                <a href="{{ route('blog.show') }}">Leggi tutto</a>
                            </div>
                        </div>
                    </article><!-- End blog entry -->

                    <article class="entry">
                        <div class="entry-img">
                            <img src="{{ asset('flex-start/img/blog/blog-2.jpg') }}" alt="" class="img-fluid">
                        </div>

                        <h2 class="entry-title">
                            <a href="{{ route('blog.show') }}">Dashboard admin moderne: cosa cambia passando a Tabler</a>
                        </h2>

                        <div class="entry-meta">
                            <ul>
                                <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="{{ route('blog.show') }}">Redazione</a></li>
                                <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="{{ route('blog.show') }}"><time datetime="2026-01-08">8 Gen, 2026</time></a></li>
                                <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="{{ route('blog.show') }}">5 Commenti</a></li>
                            </ul>
                        </div>

                        <div class="entry-content">
                            <p>
                                Migrare un pannello di amministrazione verso un tema moderno non è solo una questione estetica: significa componenti più coerenti,
                                dark mode nativa e grafici pronti all'uso. Ecco cosa abbiamo imparato durante il passaggio.
                            </p>
                            <div class="read-more">
                                <a href="{{ route('blog.show') }}">Leggi tutto</a>
                            </div>
                        </div>
                    </article><!-- End blog entry -->

                    <article class="entry">
                        <div class="entry-img">
                            <img src="{{ asset('flex-start/img/blog/blog-3.jpg') }}" alt="" class="img-fluid">
                        </div>

                        <h2 class="entry-title">
                            <a href="{{ route('blog.show') }}">Autenticazione e ruoli: un approccio pragmatico con Spatie Permission</a>
                        </h2>

                        <div class="entry-meta">
                            <ul>
                                <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="{{ route('blog.show') }}">Redazione</a></li>
                                <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="{{ route('blog.show') }}"><time datetime="2025-12-20">20 Dic, 2025</time></a></li>
                                <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="{{ route('blog.show') }}">12 Commenti</a></li>
                            </ul>
                        </div>

                        <div class="entry-content">
                            <p>
                                Gestire ruoli e permessi non deve essere complicato. Vediamo come impostare una gerarchia di ruoli chiara e manutenibile,
                                evitando le trappole più comuni quando il numero di permessi cresce.
                            </p>
                            <div class="read-more">
                                <a href="{{ route('blog.show') }}">Leggi tutto</a>
                            </div>
                        </div>
                    </article><!-- End blog entry -->

                    <article class="entry">
                        <div class="entry-img">
                            <img src="{{ asset('flex-start/img/blog/blog-4.jpg') }}" alt="" class="img-fluid">
                        </div>

                        <h2 class="entry-title">
                            <a href="{{ route('blog.show') }}">Import/export Excel in produzione: consigli pratici</a>
                        </h2>

                        <div class="entry-meta">
                            <ul>
                                <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="{{ route('blog.show') }}">Redazione</a></li>
                                <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="{{ route('blog.show') }}"><time datetime="2025-12-05">5 Dic, 2025</time></a></li>
                                <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="{{ route('blog.show') }}">3 Commenti</a></li>
                            </ul>
                        </div>

                        <div class="entry-content">
                            <p>
                                File da migliaia di righe, formati inconsistenti, colonne mancanti: l'import di dati reali è sempre più complicato del previsto.
                                Alcune strategie per rendere il processo affidabile e facile da diagnosticare quando qualcosa va storto.
                            </p>
                            <div class="read-more">
                                <a href="{{ route('blog.show') }}">Leggi tutto</a>
                            </div>
                        </div>
                    </article><!-- End blog entry -->

                    <div class="blog-pagination">
                        <ul class="justify-content-center">
                            <li class="active"><a href="{{ route('blog') }}">1</a></li>
                        </ul>
                    </div>

                </div><!-- End blog entries list -->

                <div class="col-lg-4">

                    <div class="sidebar">

                        <h3 class="sidebar-title">Cerca</h3>
                        <div class="sidebar-item search-form">
                            <form action="{{ route('blog') }}">
                                <input type="text" name="q">
                                <button type="submit"><i class="bi bi-search"></i></button>
                            </form>
                        </div><!-- End sidebar search form -->

                        <h3 class="sidebar-title">Categorie</h3>
                        <div class="sidebar-item categories">
                            <ul>
                                <li><a href="{{ route('blog') }}">Sviluppo <span>(12)</span></a></li>
                                <li><a href="{{ route('blog') }}">Design <span>(6)</span></a></li>
                                <li><a href="{{ route('blog') }}">Sicurezza <span>(4)</span></a></li>
                                <li><a href="{{ route('blog') }}">Best Practice <span>(9)</span></a></li>
                                <li><a href="{{ route('blog') }}">Tutorial <span>(15)</span></a></li>
                            </ul>
                        </div><!-- End sidebar categories -->

                        <h3 class="sidebar-title">Articoli recenti</h3>
                        <div class="sidebar-item recent-posts">
                            <div class="post-item clearfix">
                                <img src="{{ asset('flex-start/img/blog/blog-recent-1.jpg') }}" alt="">
                                <h4><a href="{{ route('blog.show') }}">Come strutturare un progetto Laravel scalabile</a></h4>
                                <time datetime="2026-01-15">15 Gen, 2026</time>
                            </div>

                            <div class="post-item clearfix">
                                <img src="{{ asset('flex-start/img/blog/blog-recent-2.jpg') }}" alt="">
                                <h4><a href="{{ route('blog.show') }}">Dashboard admin moderne con Tabler</a></h4>
                                <time datetime="2026-01-08">8 Gen, 2026</time>
                            </div>

                            <div class="post-item clearfix">
                                <img src="{{ asset('flex-start/img/blog/blog-recent-3.jpg') }}" alt="">
                                <h4><a href="{{ route('blog.show') }}">Ruoli e permessi con Spatie</a></h4>
                                <time datetime="2025-12-20">20 Dic, 2025</time>
                            </div>

                            <div class="post-item clearfix">
                                <img src="{{ asset('flex-start/img/blog/blog-recent-4.jpg') }}" alt="">
                                <h4><a href="{{ route('blog.show') }}">Import/export Excel in produzione</a></h4>
                                <time datetime="2025-12-05">5 Dic, 2025</time>
                            </div>

                            <div class="post-item clearfix">
                                <img src="{{ asset('flex-start/img/blog/blog-recent-5.jpg') }}" alt="">
                                <h4><a href="{{ route('blog.show') }}">Testing con Pest 4: primi passi</a></h4>
                                <time datetime="2025-11-22">22 Nov, 2025</time>
                            </div>
                        </div><!-- End sidebar recent posts -->

                        <h3 class="sidebar-title">Tag</h3>
                        <div class="sidebar-item tags">
                            <ul>
                                <li><a href="{{ route('blog') }}">Laravel</a></li>
                                <li><a href="{{ route('blog') }}">PHP</a></li>
                                <li><a href="{{ route('blog') }}">Bootstrap</a></li>
                                <li><a href="{{ route('blog') }}">UI</a></li>
                                <li><a href="{{ route('blog') }}">Sicurezza</a></li>
                                <li><a href="{{ route('blog') }}">Excel</a></li>
                                <li><a href="{{ route('blog') }}">Testing</a></li>
                                <li><a href="{{ route('blog') }}">API</a></li>
                            </ul>
                        </div><!-- End sidebar tags -->

                    </div><!-- End sidebar -->

                </div><!-- End blog sidebar -->

            </div>

        </div>
    </section><!-- End Blog Section -->

</main><!-- End #main -->

@endsection
