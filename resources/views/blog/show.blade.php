@extends('layouts.app-flex')

@section('content')

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('blog') }}">Blog</a></li>
                <li>Articolo</li>
            </ol>
            <h2>Come strutturare un progetto Laravel scalabile fin dal primo giorno</h2>
        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Single Section ======= -->
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">

            <div class="row">

                <div class="col-lg-8 entries">

                    <article class="entry entry-single">

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

                            <p>
                                Il primo errore che si commette di solito è mettere tutta la logica dentro i controller. Funziona, all'inizio.
                                Poi il controller cresce, i metodi si allungano, e ogni modifica diventa un rischio. La soluzione non è complicata:
                                spostare la logica di dominio in classi di servizio dedicate, mantenendo i controller sottili e concentrati solo
                                sull'orchestrazione tra richiesta HTTP e risposta.
                            </p>

                            <blockquote>
                                <p>
                                    Un controller dovrebbe leggere come un indice: poche righe, che dicono cosa succede, non come succede.
                                </p>
                            </blockquote>

                            <p>
                                Lo stesso principio vale per le Form Request, per gli Eloquent Resource e per gli Observer: ogni pezzo del framework
                                esiste per prendersi in carico una responsabilità precisa. Usarli nel modo giusto significa meno codice duplicato
                                e meno sorprese quando si torna su una funzionalità dopo mesi.
                            </p>

                            <h3>Organizzare le cartelle senza esagerare</h3>
                            <p>
                                Non serve reinventare la struttura di Laravel per avere un progetto ordinato. Bastano poche convenzioni applicate
                                con costanza: una cartella <code>Services</code> per la logica di dominio, una cartella <code>Actions</code> per le
                                operazioni singole e riusabili, e un uso disciplinato dei Form Request per la validazione. Aggiungere livelli di
                                astrazione non richiesti, invece, è spesso controproducente: tre righe simili sono meglio di un'astrazione prematura.
                            </p>
                            <img src="{{ asset('flex-start/img/blog/blog-inside-post.jpg') }}" class="img-fluid" alt="">

                            <h3>Testing come rete di sicurezza, non come formalità</h3>
                            <p>
                                Un progetto scalabile è un progetto che si può modificare senza paura. Questo è possibile solo se esiste una suite
                                di test che copre i percorsi critici dell'applicazione: autenticazione, permessi, operazioni sui dati sensibili.
                                Non serve coprire ogni riga di codice al 100%: serve coprire quello che, se si rompe, costa caro.
                            </p>
                            <p>
                                Con strumenti come Pest è possibile scrivere test leggibili quasi come una specifica testuale, il che aiuta
                                anche chi si unisce al progetto in un secondo momento a capire cosa il sistema deve garantire.
                            </p>

                        </div>

                        <div class="entry-footer">
                            <i class="bi bi-folder"></i>
                            <ul class="cats">
                                <li><a href="{{ route('blog') }}">Sviluppo</a></li>
                            </ul>

                            <i class="bi bi-tags"></i>
                            <ul class="tags">
                                <li><a href="{{ route('blog') }}">Laravel</a></li>
                                <li><a href="{{ route('blog') }}">PHP</a></li>
                                <li><a href="{{ route('blog') }}">Best Practice</a></li>
                            </ul>
                        </div>

                    </article><!-- End blog entry -->

                    <div class="blog-author d-flex align-items-center">
                        <img src="{{ asset('flex-start/img/blog/blog-author.jpg') }}" class="rounded-circle float-left" alt="">
                        <div>
                            <h4>Redazione</h4>
                            <div class="social-links">
                                <a href="#"><i class="bi bi-twitter"></i></a>
                                <a href="#"><i class="bi bi-facebook"></i></a>
                                <a href="#"><i class="bi bi-instagram"></i></a>
                            </div>
                            <p>
                                Scriviamo di sviluppo Laravel, architettura e best practice per team che costruiscono applicazioni destinate
                                a durare nel tempo.
                            </p>
                        </div>
                    </div><!-- End blog author bio -->

                    <div class="blog-comments">

                        <h4 class="comments-count">3 Commenti</h4>

                        <div id="comment-1" class="comment">
                            <div class="d-flex">
                                <div class="comment-img"><img src="{{ asset('flex-start/img/blog/comments-1.jpg') }}" alt=""></div>
                                <div>
                                    <h5><a href="#">Marco Bianchi</a> <a href="#" class="reply"><i class="bi bi-reply-fill"></i> Rispondi</a></h5>
                                    <time datetime="2026-01-16">16 Gen, 2026</time>
                                    <p>
                                        Ottimo punto sulla separazione tra controller e servizi. È il primo refactoring che facciamo sempre
                                        quando ereditiamo un progetto legacy.
                                    </p>
                                </div>
                            </div>
                        </div><!-- End comment #1 -->

                        <div id="comment-2" class="comment">
                            <div class="d-flex">
                                <div class="comment-img"><img src="{{ asset('flex-start/img/blog/comments-2.jpg') }}" alt=""></div>
                                <div>
                                    <h5><a href="#">Giulia Ferrari</a> <a href="#" class="reply"><i class="bi bi-reply-fill"></i> Rispondi</a></h5>
                                    <time datetime="2026-01-17">17 Gen, 2026</time>
                                    <p>
                                        Concordo sull'astrazione prematura: meglio codice duplicato e leggibile che un'interfaccia generica
                                        pensata per casi che non arriveranno mai.
                                    </p>
                                </div>
                            </div>

                            <div id="comment-reply-1" class="comment comment-reply">
                                <div class="d-flex">
                                    <div class="comment-img"><img src="{{ asset('flex-start/img/blog/comments-3.jpg') }}" alt=""></div>
                                    <div>
                                        <h5><a href="#">Redazione</a> <a href="#" class="reply"><i class="bi bi-reply-fill"></i> Rispondi</a></h5>
                                        <time datetime="2026-01-17">17 Gen, 2026</time>
                                        <p>
                                            Esatto, la regola pratica che usiamo è: tre ripetizioni prima di astrarre, non due.
                                        </p>
                                    </div>
                                </div>
                            </div><!-- End comment reply #1 -->

                        </div><!-- End comment #2 -->

                        <div id="comment-3" class="comment">
                            <div class="d-flex">
                                <div class="comment-img"><img src="{{ asset('flex-start/img/blog/comments-5.jpg') }}" alt=""></div>
                                <div>
                                    <h5><a href="#">Luca Romano</a> <a href="#" class="reply"><i class="bi bi-reply-fill"></i> Rispondi</a></h5>
                                    <time datetime="2026-01-18">18 Gen, 2026</time>
                                    <p>
                                        Aggiungerei anche l'importanza delle Form Request per tenere la validazione fuori dal controller.
                                        Piccola cosa che fa una grande differenza nella leggibilità.
                                    </p>
                                </div>
                            </div>
                        </div><!-- End comment #3 -->

                        <div class="reply-form">
                            <h4>Lascia un commento</h4>
                            <p>Il tuo indirizzo email non sarà pubblicato. I campi obbligatori sono contrassegnati con *</p>
                            <form action="{{ route('blog.show') }}" method="get">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <input name="name" type="text" class="form-control" placeholder="Il tuo nome*">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <input name="email" type="text" class="form-control" placeholder="La tua email*">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col form-group">
                                        <input name="website" type="text" class="form-control" placeholder="Il tuo sito web">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col form-group">
                                        <textarea name="comment" class="form-control" placeholder="Il tuo commento*"></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Pubblica commento</button>
                            </form>
                        </div>

                    </div><!-- End blog comments -->

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
    </section><!-- End Blog Single Section -->

</main><!-- End #main -->

@endsection
