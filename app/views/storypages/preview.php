<!doctype html>
<html ⚡>

<head>

    <meta charset="utf-8">
    <title><?= $data['title'] ?></title>
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
    <amp-story standalone title=print $title="Title" publisher="L'Humanité" publisher-logo-src="assets/Huma-icon.png"
        poster-portrait-src="assets/cover.jpg">




        <amp-story-page id="cover">

            <?php if (!empty($data['background-img'])) : ?>
            <amp-story-grid-layer template="fill">

                <?php if ($data['background-size'] == 'cover') : ?>

                <amp-img src="http://localhost/humastories/public/uploads/<?= $data['background-img'] ?>" width="720"
                    height="1280" layout="responsive" <?php if (!empty($data['background-animation'])) : ?>
                    animate-in="<?= $data['background-animation']; ?>"
                    animate-in-duration="<?= $data['background-animation-duration']; ?>" <?php endif; ?>>
                </amp-img>

                <?php elseif ($data['background-size'] == 'contain') : ?>
                <amp-img src="http://localhost/humastories/public/uploads/<?= $data['background-img'] ?>"
                    class="contain" <?php if (!empty($data['background-animation'])) : ?>
                    animate-in="<?= $data['background-animation']; ?>"
                    animate-in-duration="<?= $data['background-animation-duration']; ?>" <?php endif; ?>>
                </amp-img>

                <?php endif; ?>
            </amp-story-grid-layer>
            <?php endif; ?>

            <?php if ($data['text-block-size-position'] == 'full-size') : ?>
            <amp-story-grid-layer template="fill" animate-in="<?= $data['text-block-animation']; ?>"
                animate-in-duration="<?= $data['text-block-animation-duration']; ?>">
                <div>
                    <?php if (!empty($data['title'])) : ?>
                    <h1><?= $data['title'] ?></h1>
                    <?php endif; ?>
                    <?php if (!empty($data['body-text'])) : ?>
                    <p><?= $data['body-text'] ?></p>
                    <?php endif ?>
                </div>
            </amp-story-grid-layer>

            <?php elseif ($data['text-block-size-position'] == 'half-top') : ?>

            <amp-story-grid-layer template="vertical" animate-in="<?= $data['text-block-animation']; ?>"
                animate-in-duration="<?= $data['text-block-animation-duration']; ?>">
                <div>
                    <?php if (!empty($data['title'])) : ?>
                    <h1><?= $data['title'] ?></h1>
                    <?php endif; ?>
                    <?php if (!empty($data['body-text'])) : ?>
                    <p><?= $data['body-text'] ?></p>
                    <?php endif ?>
                </div>
            </amp-story-grid-layer>

            <?php elseif ($data['text-block-size-position'] == 'half-middle') : ?>
            <amp-story-grid-layer template="vertical" animate-in="<?= $data['text-block-animation']; ?>"
                animate-in-duration="<?= $data['text-block-animation-duration']; ?>">
                <div><br><br><br><br><br></div>
                <div>
                    <?php if (!empty($data['title'])) : ?>
                    <h1><?= $data['title'] ?></h1>
                    <?php endif; ?>
                    <?php if (!empty($data['body-text'])) : ?>
                    <p><?= $data['body-text'] ?></p>
                    <?php endif ?>
                </div>
            </amp-story-grid-layer>

            <?php elseif ($data['text-block-size-position'] == 'half-bottom') : ?>

            <amp-story-grid-layer template="vertical" animate-in="<?= $data['text-block-animation']; ?>"
                animate-in-duration="<?= $data['text-block-animation-duration']; ?>">
                <div><br><br><br><br><br><br><br><br><br><br></div>
                <div>
                    <?php if (!empty($data['title'])) : ?>
                    <h1><?= $data['title'] ?></h1>
                    <?php endif; ?>
                    <?php if (!empty($data['body-text'])) : ?>
                    <p><?= $data['body-text'] ?></p>
                    <?php endif ?>
                </div>
            </amp-story-grid-layer>

            <?php elseif ($data['text-block-size-position'] == 'third-top') : ?>


            <amp-story-grid-layer template="thirds" animate-in="<?= $data['text-block-animation']; ?>"
                animate-in-duration="<?= $data['text-block-animation-duration']; ?>">

                <div grid-area="upper-third">
                    <?php if (!empty($data['title'])) : ?>
                    <h1><?= $data['title'] ?></h1>
                    <?php endif; ?>
                    <?php if (!empty($data['body-text'])) : ?>
                    <p><?= $data['body-text'] ?></p>
                    <?php endif ?>
                </div>
            </amp-story-grid-layer>
            <?php elseif ($data['text-block-size-position'] == 'third-middle') : ?>

            <amp-story-grid-layer template="thirds" animate-in="<?= $data['text-block-animation']; ?>"
                animate-in-duration="<?= $data['text-block-animation-duration']; ?>">

                <div grid-area="middle-third">
                    <?php if (!empty($data['title'])) : ?>
                    <h1><?= $data['title'] ?></h1>
                    <?php endif; ?>
                    <?php if (!empty($data['body-text'])) : ?>
                    <p><?= $data['body-text'] ?></p>
                    <?php endif ?>
                </div>
            </amp-story-grid-layer>
            <?php elseif ($data['text-block-size-position'] == 'third-bottom') : ?>

            <amp-story-grid-layer template="thirds" animate-in="<?= $data['text-block-animation']; ?>"
                animate-in-duration="<?= $data['text-block-animation-duration']; ?>">

                <div grid-area="lower-third">
                    <?php if (!empty($data['title'])) : ?>
                    <h1><?= $data['title'] ?></h1>
                    <?php endif; ?>
                    <?php if (!empty($data['body-text'])) : ?>
                    <p><?= $data['body-text'] ?></p>
                    <?php endif ?>
                </div>
            </amp-story-grid-layer>
            <?php endif ?>


        </amp-story-page>
</body>