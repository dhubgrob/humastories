<!doctype html>
<html ⚡>

<head>

    <meta charset="utf-8">
    <title><?= $data['story']->title ?></title>
    <link rel="canonical" href="temp.html">
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <style amp-boilerplate>
    body {
        -webkit-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
        -moz-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
        -ms-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
        animation: -amp-start 8s steps(1, end) 0s 1 normal both
    }

    @-webkit-keyframes -amp-start {
        from {
            visibility: hidden
        }

        to {
            visibility: visible
        }
    }

    @-moz-keyframes -amp-start {
        from {
            visibility: hidden
        }

        to {
            visibility: visible
        }
    }

    @-ms-keyframes -amp-start {
        from {
            visibility: hidden
        }

        to {
            visibility: visible
        }
    }

    @-o-keyframes -amp-start {
        from {
            visibility: hidden
        }

        to {
            visibility: visible
        }
    }

    @keyframes -amp-start {
        from {
            visibility: hidden
        }

        to {
            visibility: visible
        }
    }
    </style><noscript>
        <style amp-boilerplate>
        body {
            -webkit-animation: none;
            -moz-animation: none;
            -ms-animation: none;
            animation: none
        }
        </style>
    </noscript>
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <script async custom-element="amp-video" src="https://cdn.ampproject.org/v0/amp-video-0.1.js"></script>
    <script async custom-element="amp-story" src="https://cdn.ampproject.org/v0/amp-story-1.0.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400" rel="stylesheet">
    <style amp-custom>
    amp-story {
        font-family: 'Oswald', sans-serif;
        color: #fff;
    }

    amp-story-page {
        background-color: #000;
    }

    h1 {
        font-weight: bold;
        font-size: 2.875em;
        font-weight: normal;
        line-height: 1.174;
    }

    p {
        font-weight: normal;
        font-size: 1.3em;
        line-height: 1.5em;
        color: #fff;
    }

    q {
        font-weight: 300;
        font-size: 1.1em;
    }

    amp-story-grid-layer.bottom {
        align-content: end;
    }

    amp-story-grid-layer.noedge {
        padding: 0px;
    }

    amp-story-grid-layer.center-text {
        align-content: center;
    }

    .wrapper {
        display: grid;
        grid-template-columns: 50% 50%;
        grid-template-rows: 50% 50%;
    }

    .banner-text {
        text-align: center;
        background-color: #000;
        line-height: 2em;
    }

    .fixed-container {
        position: relative;
        width: 720px;
        height: 1280px;
    }

    amp-img.contain img {
        object-fit: contain;
    }

    amp-img.cover img {
        object-fit: cover;
    }
    </style>
</head>

<body>
    <amp-story standalone title=print $title="<?= $data['story']->title ?>" publisher="L'Humanité"
        publisher-logo-src="assets/Huma-icon.png" poster-portrait-src="assets/cover.jpg">

        <?php foreach ($data['storypages'] as $storypage) : ?>

        <?php if ($storypage->cover == 1) : ?>
        <amp-story-page id="cover">
            <?php else : ?>
            <amp-story-page id="<?= $storypage->sub_id ?>">
                <?php endif; ?>

                <?php if (!empty($storypage->filename_background_img)) : ?>
                <amp-story-grid-layer template="fill">

                    <?php if ($storypage->size_background_img == 'cover') : ?>

                    <amp-img
                        src="http://localhost/humastories/public/uploads/<?= $storypage->filename_background_img ?>"
                        width="720" height="1280" layout="responsive"
                        <?php if (!empty($storypage->animation_background_img)) : ?>
                        animate-in="<?= $storypage->animation_background_img; ?>"
                        animate-in-duration="<?= $storypage->animation_background_img_duration; ?>" <?php endif; ?>>
                    </amp-img>

                    <?php elseif ($storypage->size_background_img == 'contain') : ?>
                    <amp-img
                        src="http://localhost/humastories/public/uploads/<?= $storypage->filename_background_img ?>"
                        class="contain" <?php if (!empty($storypage->animation_background_img)) : ?>
                        animate-in="<?= $storypage->animation_background_img; ?>"
                        animate-in-duration="<?= $storypage->animation_background_img_duration; ?>" <?php endif; ?>>
                    </amp-img>

                    <?php endif; ?>
                </amp-story-grid-layer>
                <?php endif; ?>

                <?php if ($storypage->size_position_text_block == 'full-size') : ?>
                <amp-story-grid-layer template="fill" <?php if (!empty($storypage->animation_text_block)) : ?>
                    animate-in="<?= $storypage->animation_text_block; ?>"
                    animate-in-duration="<?= $storypage->animation_text_block_duration; ?>" <?php endif ?>>
                    <div>
                        <?php if (!empty($storypage->title)) : ?>
                        <h1><?= $storypage->title ?></h1>
                        <?php endif; ?>
                        <?php if (!empty($storypage->body)) : ?>
                        <p><?= $storypage->body ?></p>
                        <?php endif ?>
                    </div>
                </amp-story-grid-layer>

                <?php elseif ($storypage->size_position_text_block == 'half-top') : ?>

                <amp-story-grid-layer template="vertical" <?php if (!empty($storypage->animation_text_block)) : ?>
                    animate-in="<?= $storypage->animation_text_block; ?>"
                    animate-in-duration="<?= $storypage->animation_text_block_duration; ?>" <?php endif ?>>
                    <div>
                        <?php if (!empty($storypage->title)) : ?>
                        <h1><?= $storypage->title ?></h1>
                        <?php endif; ?>
                        <?php if (!empty($storypage->body)) : ?>
                        <p><?= $storypage->body ?></p>
                        <?php endif ?>
                    </div>
                </amp-story-grid-layer>

                <?php elseif ($storypage->size_position_text_block == 'half-middle') : ?>
                <amp-story-grid-layer template="vertical" <?php if (!empty($storypage->animation_text_block)) : ?>
                    animate-in="<?= $storypage->animation_text_block; ?>"
                    animate-in-duration="<?= $storypage->animation_text_block_duration; ?>" <?php endif ?>>
                    <div><br><br><br><br><br></div>
                    <div>
                        <?php if (!empty($storypage->title)) : ?>
                        <h1><?= $storypage->title ?></h1>
                        <?php endif; ?>
                        <?php if (!empty($storypage->body)) : ?>
                        <p><?= $storypage->body ?></p>
                        <?php endif ?>
                    </div>
                </amp-story-grid-layer>

                <?php elseif ($storypage->size_position_text_block == 'half-bottom') : ?>

                <amp-story-grid-layer template="vertical"
                    <?php if (!empty($storypage->animation_text_block)) : ?>animate-in="<?= $storypage->animation_text_block; ?>"
                    animate-in-duration="<?= $storypage->animation_text_block_duration; ?>" <?php endif ?>>
                    <div><br><br><br><br><br><br><br><br><br><br></div>
                    <div>
                        <?php if (!empty($storypage->title)) : ?>
                        <h1><?= $storypage->title ?></h1>
                        <?php endif; ?>
                        <?php if (!empty($storypage->body)) : ?>
                        <p><?= $storypage->body ?></p>
                        <?php endif ?>
                    </div>
                </amp-story-grid-layer>

                <?php elseif ($storypage->size_position_text_block == 'third-top') : ?>


                <amp-story-grid-layer template="thirds" <?php if (!empty($storypage->animation_text_block)) : ?>
                    animate-in="<?= $storypage->animation_text_block; ?>"
                    animate-in-duration="<?= $storypage->animation_text_block_duration; ?>" <?php endif; ?>>

                    <div grid-area="upper-third">
                        <?php if (!empty($storypage->title)) : ?>
                        <h1><?= $storypage->title ?></h1>
                        <?php endif; ?>
                        <?php if (!empty($storypage->body)) : ?>
                        <p><?= $storypage->body ?></p>
                        <?php endif ?>
                    </div>
                </amp-story-grid-layer>
                <?php elseif ($storypage->size_position_text_block == 'third-middle') : ?>

                <amp-story-grid-layer template="thirds" <?php if (!empty($storypage->animation_text_block)) : ?>
                    animate-in="<?= $storypage->animation_text_block; ?>"
                    animate-in-duration="<?= $storypage->animation_text_block_duration; ?>" <?php endif; ?>>

                    <div grid-area="middle-third">
                        <?php if (!empty($storypage->title)) : ?>
                        <h1><?= $storypage->title ?></h1>
                        <?php endif; ?>
                        <?php if (!empty($storypage->body)) : ?>
                        <p><?= $storypage->body ?></p>
                        <?php endif ?>
                    </div>
                </amp-story-grid-layer>
                <?php elseif ($storypage->size_position_text_block == 'third-bottom') : ?>

                <amp-story-grid-layer template="thirds" <?php if (!empty($storypage->animation_text_block)) : ?>
                    animate-in="<?= $storypage->animation_text_block; ?>"
                    animate-in-duration="<?= $storypage->animation_text_block_duration; ?>" <?php endif; ?>>

                    <div grid-area="lower-third">
                        <?php if (!empty($storypage->title)) : ?>
                        <h1><?= $storypage->title ?></h1>
                        <?php endif; ?>
                        <?php if (!empty($storypage->body)) : ?>
                        <p><?= $storypage->body ?></p>
                        <?php endif ?>
                    </div>
                </amp-story-grid-layer>
                <?php endif ?>
            </amp-story-page>
            <?php endforeach ?>


            <!-- Bookend -->
            <amp-story-bookend layout="nodisplay">
                <<?= $data['script-tag-open'] ?>>
                    {
                    "bookendVersion": "v1.0",
                    "shareProviders": [
                    "facebook",
                    "twitter",
                    "email",
                    "instagram"
                    ],
                    "components": [{
                    "type": "heading",
                    "text": "More to read"
                    },
                    {
                    "type": "landscape",
                    "title": "<?= $data['story']->linked_content_title ?>",
                    "url": "<?= $data['story']->linked_content_url ?>",
                    "image": "http://localhost/humastories/public/uploads/<?= $data['story']->linked_content_img ?>"
                    }
                    ]
                    }
                    </script>
            </amp-story-bookend>
            <amp-story>
            </amp-story>



    </amp-story>
</body>

</html>