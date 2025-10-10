@extends('user.layouts.layout')
@section('title', 'Blog Details')
@section('content')

<!-- shared hosting banner -->
<div class="rts-hosting-banner rts-hosting-banner-bg banner-default-height">
    <div class="container">
        <div class="row">
            <div class="banner-area">
                <div class="rts-hosting-banner rts-hosting-banner__content blog__banner">
                    <span class="starting__price">Blog & Article </span>
                    <h1 class="banner-title">
                        Latest News & Articale
                    </h1>
                    <p class="slogan">You can also do this by logging into a server directly, but the process requires some technical knowledge since a single mistake can break your entire site...</p>
                    <div class="hosting-action">
                        <a href="blog.details.php" class="btn__two secondary__bg secondary__color">View Details <i class="fa-regular fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="rts-hosting-banner__image blog">
                    <img src="{{ asset('user-assets/images/banner/banner__blog__image') }}" alt="">
                    <img class="shape one left-right" src="{{ asset('user-assets/images/banner/banner__blog__image-sm1') }}" alt="">
                    <img class="shape two show-hide" src="{{ asset('user-assets/images/banner/banner__blog__image-sm2') }}" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- shared hosting banner end-->

<!-- BLOG DETAILS -->
<div class="rts-blog-details section__padding">
    <div class="container">
        <div class="row g-40">
            <div class="col-lg-8">
                <article class="blog-details">
                    <div class="blog-details__featured-image">
                        <img src="{{ asset('user-assets/images/blog/blog-post-details.jpg') }}" alt="blog post">
                    </div>
                    <div class="blog-details__article-meta mt--40">
                        <a href="#"><span><i class="fa-light fa-user"></i></span>Zayed Khan</a>
                        <span><span><i class="fa-light fa-clock"></i></span>20 Jan 2024, 10:30 pm</span>
                        <a href="#"><span><i class="fa-sharp fa-light fa-tags"></i></span>Hosting Feature</a>
                    </div>
                    <h3 class="blog-title">Building smart business solution for you</h3>
                    <p>Collaboratively pontificate bleeding edge resources with inexpensive methodologies globally initiate multidisciplinary compatible architectures pidiously repurpose leading edge growth strategies with just in time web readiness communicate timely meta services </p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa dolorum officia iure, culpa nesciunt omnis voluptas libero hic dicta vitae nulla quisquam modi deserunt, voluptatibus reprehenderit non ipsum exercitationem maxime cum! Veniam quaerat, incidunt odio sunt voluptatum nostrum quod dolorem et iusto magni, laborum ut a atque voluptatibus voluptates corrupti consequatur? Neque tempora totam blanditiis doloribus omnis ducimus consequuntur quod ipsum repellat iure, in molestiae magnam quia! Ullam natus illo, voluptates nemo fuga laboriosam distinctio nisi consequuntur quia aut repudiandae delectus cumque officia ab minima suscipit voluptate ea velit hic sint quas dignissimos autem qui earum! Incidunt iure inventore qui.</p>
                    <blockquote class="rts-blockquote">
                        <h4>Building smart business solution for you</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo repellat vero dicta velit, doloribus, fugit exercitationem sapiente quibusdam voluptatibus deserunt quasi alias ducimus corrupti Lorem ipsum dolor sit amet..</p>
                        <span>Maria Sarapoba</span>
                    </blockquote>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod aliquid perferendis magni nihil beatae, delectus recusandae minus sequi molestiae iste, perspiciatis expedita amet suscipit? Consequatur accusantium sed voluptatem et nulla dicta tempora. Error numquam earum, adipisci quod, placeat voluptatibus similique sunt quis saepe omnis itaque. Vero saepe eius iste, veritatis voluptas tenetur, porro repellat rem, quia fugiat ad sunt architecto amet expedita. Quibusdam recusandae adipisci ipsa tenetur, nostrum quasi ut veritatis et rerum! Amet odio nam animi adipisci reprehenderit nostrum repellat labore dignissimos. Tenetur distinctio possimus veritatis quasi unde rem nesciunt maiores vel eveniet id! Eveniet deserunt atque molestiae alias!</p>
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <div class="post-image">
                                <img src="{{ asset('user-assets/images/blog/post-1.jpg') }}" alt="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="post-image">
                                <img src="{{ asset('user-assets/images/blog/post-2.jpg') }}" alt="">
                            </div>
                        </div>
                    </div>
                    <h3 class="sub-title fw-bold">Building smart business solution for you</h3>
                    <p>Gravida maecenas lobortis suscipit mus sociosqu convallis, mollis vestibulum donec aliquam risus sapien ridiculus, nulla sollicitudin eget in venenatis. Tortor montes platea iaculis posuere per mauris, eros porta blandit curabitur ullamcorper varius nostra ante risus egestas. </p>
                    <div class="row mb-5 align-items-center">
                        <div class="col-md-5">
                            <div class="post-image mb-5 mb-lg-0">
                                <img src="{{ asset('user-assets/images/blog/post-3.jpg') }}" alt="">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="check-area-details">
                                <div class="single-check">
                                    <i class="far fa-check-circle"></i>
                                    <span>How will activities traditional manufacturing</span>
                                </div>
                                <div class="single-check">
                                    <i class="far fa-check-circle"></i>
                                    <span>All these digital and projects aim to enhance</span>
                                </div>
                                <div class="single-check">
                                    <i class="far fa-check-circle"></i>
                                    <span>I monitor my software that takes screenshots</span>
                                </div>
                                <div class="single-check">
                                    <i class="far fa-check-circle"></i>
                                    <span>Laoreet dolore niacin sodium glutimate
                                    </span>
                                </div>
                                <div class="single-check">
                                    <i class="far fa-check-circle"></i>
                                    <span>Minim veniam sodium glutimate nostrud</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui facere architecto obcaecati quam temporibus aut sunt, perferendis mollitia nisi, vel hic nostrum? Numquam eos autem vel rem minima sint natus, voluptatem voluptatum quia nulla fugiat reprehenderit porro, harum fuga? Neque explicabo voluptatem expedita consectetur in, sunt nisi non id doloremque.</p>
                </article>
                <div class="blog-info">
                    <div class="blog-tags">
                        <div class="tags-title">tags:</div>
                        <div class="blog-tags__list">
                            <a href="#">Service</a>
                            <a href="#">Hosting</a>
                            <a href="#">Vps</a>
                            <a href="#">Reseller</a>
                        </div>
                    </div>
                    <div class="blog-share">
                        <div class="share">Share:</div>
                        <div class="social__media--list">
                            <a href="#" class="media"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="#" class="media"><i class="fa-brands fa-instagram"></i></a>
                            <a href="#" class="media"><i class="fa-brands fa-linkedin"></i></a>
                            <a href="#" class="media"><i class="fa-brands fa-twitter"></i></a>
                            <a href="#" class="media"><i class="fa-brands fa-behance"></i></a>
                        </div>
                    </div>
                </div>
                <div class="blog-author">
                    <div class="blog-author__info">
                        <div class="author-image">
                            <img src="{{ asset('user-assets/images/blog/author.jpg') }}" alt="">
                        </div>
                        <div class="author-content">
                            <a href="#">Maria Sara Khan</a>
                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tempora, temporibus?</p>
                            <div class="social__media--list">
                                <a href="#" class="media"><i class="fa-brands fa-facebook-f"></i></a>
                                <a href="#" class="media"><i class="fa-brands fa-instagram"></i></a>
                                <a href="#" class="media"><i class="fa-brands fa-linkedin"></i></a>
                                <a href="#" class="media"><i class="fa-brands fa-twitter"></i></a>
                                <a href="#" class="media"><i class="fa-brands fa-behance"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="blog-comment mb-5 mb-lg-0">
                    <div class="blog-comment__template">
                        <h4>Share your opinion here !</h4>
                        <form action="#" class="comment-template">
                            <div class="input-area">
                                <input type="text" placeholder="Enter your name" required>
                                <input type="text" placeholder="Enter your email" required>
                            </div>
                            <div class="input-area-full">
                                <input type="text" placeholder="Enter your Subject" required>
                            </div>
                            <textarea name="msg" class="input-area-full w-full" placeholder="Enter Your Message"></textarea>
                            <button class="rts-btn rts-btn-secondary w-auto" type="submit">Submit Review</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="rts-sidebar">
                    <!-- single widget -->
                    <div class="rts-single-widget search-widget">
                        <form action="#" method="post">
                            <input type="text" name="s" id="search" placeholder="Enter Keyword" required>
                            <button type="submit"><i class="fa-regular fa-search"></i></button>
                        </form>
                    </div>
                    <!-- single widget end -->
                    <!-- single widget start -->
                    <div class="rts-single-widget category-widget">
                        <h4 class="widget-title">All Services</h4>
                        <ul class="list-unstyled cat__counter">
                            <li class="single-cat">
                                <a href="#">Space Planning <span><i class="fa-regular fa-arrow-right"></i></span></a>
                            </li>
                            <li class="single-cat">
                                <a href="#">Interior design <span><i class="fa-regular fa-arrow-right"></i></span></a>
                            </li>
                            <li class="single-cat">
                                <a href="#">Remodeling Services <span><i class="fa-regular fa-arrow-right"></i></span></a>
                            </li>
                            <li class="single-cat">
                                <a href="#">Urban Planning <span><i class="fa-regular fa-arrow-right"></i></span></a>
                            </li>
                            <li class="single-cat">
                                <a href="#">Kitchen Cabinet <span><i class="fa-regular fa-arrow-right"></i></span></a>
                            </li>
                            <li class="single-cat">
                                <a href="#">3d Visualization <span><i class="fa-regular fa-arrow-right"></i></span></a>
                            </li>
                        </ul>
                    </div>
                    <!-- single widget end -->
                    <!-- single widget start -->
                    <div class="rts-single-widget recentpost-widget">
                        <h4 class="widget-title">Recent Post</h4>
                        <div class="recent-posts">
                            <div class="single-post">
                                <div class="thumb">
                                    <img src="{{ asset('user-assets/images/blog/blog-recent-1.png') }}" alt="" height="85" width="85">
                                </div>
                                <div class="meta">
                                    <span class="published"><i class="fa-regular fa-clock"></i> 15 Jan, 2023</span>
                                    <h6 class="title"><a href="#">We would love to share a similar experience</a></h6>
                                </div>
                            </div>
                            <div class="single-post">
                                <div class="thumb">
                                    <img src="{{ asset('user-assets/images/blog/blog-recent-2.png') }}" alt="" height="85" width="85">
                                </div>
                                <div class="meta">
                                    <span class="published"><i class="fa-regular fa-clock"></i> 15 Jan, 2023</span>
                                    <h6 class="title"><a href="#">We would love to share a similar experience</a></h6>
                                </div>
                            </div>
                            <div class="single-post">
                                <div class="thumb">
                                    <img src="{{ asset('user-assets/images/blog/blog-recent-3.png') }}" alt="" height="85" width="85">
                                </div>
                                <div class="meta">
                                    <span class="published"><i class="fa-regular fa-clock"></i> 15 Jan, 2023</span>
                                    <h6 class="title"><a href="#">We would love to share a similar experience</a></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- single widget end -->


                    <!-- single widget start -->
                    <div class="rts-single-widget gallery-widget">
                        <h4 class="widget-title">Gallery Post</h4>
                        <div class="gallery-posts">
                            <a href="blog-details.php" class="thumb">
                                <img src="{{ asset('user-assets/images/blog/gallery-post-1.png') }}" height="95" width="95" alt="">
                            </a>
                            <a href="blog-details.php" class="thumb">
                                <img src="{{ asset('user-assets/images/blog/gallery-post-2.png') }}" height="95" width="95" alt="">
                            </a>
                            <a href="blog-details.php" class="thumb">
                                <img src="{{ asset('user-assets/images/blog/gallery-post-3.png') }}" height="95" width="95" alt="">
                            </a>
                            <a href="blog-details.php" class="thumb">
                                <img src="{{ asset('user-assets/images/blog/gallery-post-4.png') }}" height="95" width="95" alt="">
                            </a>
                            <a href="blog-details.php" class="thumb">
                                <img src="{{ asset('user-assets/images/blog/gallery-post-5.png') }}" height="95" width="95" alt="">
                            </a>
                            <a href="blog-details.php" class="thumb">
                                <img src="{{ asset('user-assets/images/blog/gallery-post-6.png') }}" height="95" width="95" alt="">
                            </a>
                        </div>
                    </div>
                    <!-- single widget end -->

                    <!-- single widget start -->
                    <div class="rts-single-widget tags-widget">
                        <h4 class="widget-title">popular tags</h4>
                        <div class="popular-tags">
                            <ul class="list-unstyled tags-style">
                                <li class="tags"><a href="#">service</a></li>
                                <li class="tags"><a href="#">Business</a></li>
                                <li class="tags"><a href="#">Growth</a></li>
                                <li class="tags"><a href="#">Kitchen</a></li>
                                <li class="tags"><a href="#">Interior Design</a></li>
                                <li class="tags"><a href="#">Solution</a></li>
                                <li class="tags"><a href="#">Urban</a></li>
                                <li class="tags"><a href="#">Buildings</a></li>
                                <li class="tags"><a href="#">Architecture</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- single widget end -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- BLOG DETAILS END -->

@endsection