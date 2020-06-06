(function($, window) {
    'use strict';

    var emoji = [
        {
            "name": "smile",
            "value": "\u{1f604}",
            "category": "people"
        },
        {
            "name": "smiley",
            "value": "\u{1f603}",
            "category": "people"
        },
        {
            "name": "grinning",
            "value": "\u{1f600}",
            "category": "people"
        },
        {
            "name": "blush",
            "value": "\u{1f60a}",
            "category": "people"
        },
        {
            "name": "relaxed",
            "value": "\u{263a}",
            "category": "people"
        },
        {
            "name": "wink",
            "value": "\u{1f609}",
            "category": "people"
        },
        {
            "name": "heart-eyes",
            "value": "\u{1f60d}",
            "category": "people"
        },
        {
            "name": "kissing-heart",
            "value": "\u{1f618}",
            "category": "people"
        },
        {
            "name": "kissing-closed-eyes",
            "value": "\u{1f61a}",
            "category": "people"
        },
        {
            "name": "kissing",
            "value": "\u{1f617}",
            "category": "people"
        },
        {
            "name": "kissing-smiling-eyes",
            "value": "\u{1f619}",
            "category": "people"
        },
        {
            "name": "stuck-out-tongue-winking-eye",
            "value": "\u{1f61c}",
            "category": "people"
        },
        {
            "name": "stuck-out-tongue-closed-eyes",
            "value": "\u{1f61d}",
            "category": "people"
        },
        {
            "name": "stuck-out-tongue",
            "value": "\u{1f61b}",
            "category": "people"
        },
        {
            "name": "flushed",
            "value": "\u{1f633}",
            "category": "people"
        },
        {
            "name": "grin",
            "value": "\u{1f601}",
            "category": "people"
        },
        {
            "name": "pensive",
            "value": "\u{1f614}",
            "category": "people"
        },
        {
            "name": "satisfied",
            "value": "\u{1f60c}",
            "category": "people"
        },
        {
            "name": "unamused",
            "value": "\u{1f612}",
            "category": "people"
        },
        {
            "name": "disappointed",
            "value": "\u{1f61e}",
            "category": "people"
        },
        {
            "name": "persevere",
            "value": "\u{1f623}",
            "category": "people"
        },
        {
            "name": "cry",
            "value": "\u{1f622}",
            "category": "people"
        },
        {
            "name": "joy",
            "value": "\u{1f602}",
            "category": "people"
        },
        {
            "name": "sob",
            "value": "\u{1f62d}",
            "category": "people"
        },
        {
            "name": "sleepy",
            "value": "\u{1f62a}",
            "category": "people"
        },
        {
            "name": "relieved",
            "value": "\u{1f625}",
            "category": "people"
        },
        {
            "name": "cold-sweat",
            "value": "\u{1f630}",
            "category": "people"
        },
        {
            "name": "sweat-smile",
            "value": "\u{1f605}",
            "category": "people"
        },
        {
            "name": "sweat",
            "value": "\u{1f613}",
            "category": "people"
        },
        {
            "name": "weary",
            "value": "\u{1f629}",
            "category": "people"
        },
        {
            "name": "tired-face",
            "value": "\u{1f62b}",
            "category": "people"
        },
        {
            "name": "fearful",
            "value": "\u{1f628}",
            "category": "people"
        },
        {
            "name": "scream",
            "value": "\u{1f631}",
            "category": "people"
        },
        {
            "name": "angry",
            "value": "\u{1f620}",
            "category": "people"
        },
        {
            "name": "rage",
            "value": "\u{1f621}",
            "category": "people"
        },
        {
            "name": "triumph",
            "value": "\u{1f624}",
            "category": "people"
        },
        {
            "name": "confounded",
            "value": "\u{1f616}",
            "category": "people"
        },
        {
            "name": "laughing",
            "value": "\u{1f606}",
            "category": "people"
        },
        {
            "name": "yum",
            "value": "\u{1f60b}",
            "category": "people"
        },
        {
            "name": "mask",
            "value": "\u{1f637}",
            "category": "people"
        },
        {
            "name": "sunglasses",
            "value": "\u{1f60e}",
            "category": "people"
        },
        {
            "name": "sleeping",
            "value": "\u{1f634}",
            "category": "people"
        },
        {
            "name": "dizzy-face",
            "value": "\u{1f635}",
            "category": "people"
        },
        {
            "name": "astonished",
            "value": "\u{1f632}",
            "category": "people"
        },
        {
            "name": "worried",
            "value": "\u{1f61f}",
            "category": "people"
        },
        {
            "name": "frowning",
            "value": "\u{1f626}",
            "category": "people"
        },
        {
            "name": "anguished",
            "value": "\u{1f627}",
            "category": "people"
        },
        {
            "name": "smiling-imp",
            "value": "\u{1f608}",
            "category": "people"
        },
        {
            "name": "imp",
            "value": "\u{1f47f}",
            "category": "people"
        },
        {
            "name": "open-mouth",
            "value": "\u{1f62e}",
            "category": "people"
        },
        {
            "name": "grimacing",
            "value": "\u{1f62c}",
            "category": "people"
        },
        {
            "name": "neutral-face",
            "value": "\u{1f610}",
            "category": "people"
        },
        {
            "name": "confused",
            "value": "\u{1f615}",
            "category": "people"
        },
        {
            "name": "hushed",
            "value": "\u{1f62f}",
            "category": "people"
        },
        {
            "name": "no-mouth",
            "value": "\u{1f636}",
            "category": "people"
        },
        {
            "name": "innocent",
            "value": "\u{1f607}",
            "category": "people"
        },
        {
            "name": "smirk",
            "value": "\u{1f60f}",
            "category": "people"
        },
        {
            "name": "expressionless",
            "value": "\u{1f611}",
            "category": "people"
        },
        {
            "name": "man-with-gua-pi-mao",
            "value": "\u{1f472}",
            "category": "people"
        },
        {
            "name": "man-with-turban",
            "value": "\u{1f473}",
            "category": "people"
        },
        {
            "name": "cop",
            "value": "\u{1f46e}",
            "category": "people"
        },
        {
            "name": "construction-worker",
            "value": "\u{1f477}",
            "category": "people"
        },
        {
            "name": "guardsman",
            "value": "\u{1f482}",
            "category": "people"
        },
        {
            "name": "baby",
            "value": "\u{1f476}",
            "category": "people"
        },
        {
            "name": "boy",
            "value": "\u{1f466}",
            "category": "people"
        },
        {
            "name": "girl",
            "value": "\u{1f467}",
            "category": "people"
        },
        {
            "name": "man",
            "value": "\u{1f468}",
            "category": "people"
        },
        {
            "name": "woman",
            "value": "\u{1f469}",
            "category": "people"
        },
        {
            "name": "older-man",
            "value": "\u{1f474}",
            "category": "people"
        },
        {
            "name": "older-woman",
            "value": "\u{1f475}",
            "category": "people"
        },
        {
            "name": "person-with-blond-hair",
            "value": "\u{1f471}",
            "category": "people"
        },
        {
            "name": "angel",
            "value": "\u{1f47c}",
            "category": "people"
        },
        {
            "name": "princess",
            "value": "\u{1f478}",
            "category": "people"
        },
        {
            "name": "smiley-cat",
            "value": "\u{1f63a}",
            "category": "people"
        },
        {
            "name": "smile-cat",
            "value": "\u{1f638}",
            "category": "people"
        },
        {
            "name": "heart-eyes-cat",
            "value": "\u{1f63b}",
            "category": "people"
        },
        {
            "name": "kissing-cat",
            "value": "\u{1f63d}",
            "category": "people"
        },
        {
            "name": "smirk-cat",
            "value": "\u{1f63c}",
            "category": "people"
        },
        {
            "name": "scream-cat",
            "value": "\u{1f640}",
            "category": "people"
        },
        {
            "name": "crying-cat-face",
            "value": "\u{1f63f}",
            "category": "people"
        },
        {
            "name": "joy-cat",
            "value": "\u{1f639}",
            "category": "people"
        },
        {
            "name": "pouting-cat",
            "value": "\u{1f63e}",
            "category": "people"
        },
        {
            "name": "japanese-ogre",
            "value": "\u{1f479}",
            "category": "people"
        },
        {
            "name": "japanese-goblin",
            "value": "\u{1f47a}",
            "category": "people"
        },
        {
            "name": "see-no-evil",
            "value": "\u{1f648}",
            "category": "people"
        },
        {
            "name": "hear-no-evil",
            "value": "\u{1f649}",
            "category": "people"
        },
        {
            "name": "speak-no-evil",
            "value": "\u{1f64a}",
            "category": "people"
        },
        {
            "name": "skull",
            "value": "\u{1f480}",
            "category": "people"
        },
        {
            "name": "alien",
            "value": "\u{1f47d}",
            "category": "people"
        },
        {
            "name": "poop",
            "value": "\u{1f4a9}",
            "category": "people"
        },
        {
            "name": "fire",
            "value": "\u{1f525}",
            "category": "people"
        },
        {
            "name": "sparkles",
            "value": "\u{2728}",
            "category": "people"
        },
        {
            "name": "star2",
            "value": "\u{1f31f}",
            "category": "people"
        },
        {
            "name": "dizzy",
            "value": "\u{1f4ab}",
            "category": "people"
        },
        {
            "name": "boom",
            "value": "\u{1f4a5}",
            "category": "people"
        },
        {
            "name": "anger",
            "value": "\u{1f4a2}",
            "category": "people"
        },
        {
            "name": "sweat-drops",
            "value": "\u{1f4a6}",
            "category": "people"
        },
        {
            "name": "droplet",
            "value": "\u{1f4a7}",
            "category": "people"
        },
        {
            "name": "zzz",
            "value": "\u{1f4a4}",
            "category": "people"
        },
        {
            "name": "dash",
            "value": "\u{1f4a8}",
            "category": "people"
        },
        {
            "name": "ear",
            "value": "\u{1f442}",
            "category": "people"
        },
        {
            "name": "eyes",
            "value": "\u{1f440}",
            "category": "people"
        },
        {
            "name": "nose",
            "value": "\u{1f443}",
            "category": "people"
        },
        {
            "name": "tongue",
            "value": "\u{1f445}",
            "category": "people"
        },
        {
            "name": "lips",
            "value": "\u{1f444}",
            "category": "people"
        },
        {
            "name": "thumbsup",
            "value": "\u{1f44d}",
            "category": "people"
        },
        {
            "name": "thumbsdown",
            "value": "\u{1f44e}",
            "category": "people"
        },
        {
            "name": "ok-hand",
            "value": "\u{1f44c}",
            "category": "people"
        },
        {
            "name": "punch",
            "value": "\u{1f44a}",
            "category": "people"
        },
        {
            "name": "fist",
            "value": "\u{270a}",
            "category": "people"
        },
        {
            "name": "v",
            "value": "\u{270c}",
            "category": "people"
        },
        {
            "name": "wave",
            "value": "\u{1f44b}",
            "category": "people"
        },
        {
            "name": "hand",
            "value": "\u{270b}",
            "category": "people"
        },
        {
            "name": "open-hands",
            "value": "\u{1f450}",
            "category": "people"
        },
        {
            "name": "point-up-2",
            "value": "\u{1f446}",
            "category": "people"
        },
        {
            "name": "point-down",
            "value": "\u{1f447}",
            "category": "people"
        },
        {
            "name": "point-right",
            "value": "\u{1f449}",
            "category": "people"
        },
        {
            "name": "point-left",
            "value": "\u{1f448}",
            "category": "people"
        },
        {
            "name": "raised-hands",
            "value": "\u{1f64c}",
            "category": "people"
        },
        {
            "name": "pray",
            "value": "\u{1f64f}",
            "category": "people"
        },
        {
            "name": "point-up",
            "value": "\u{261d}",
            "category": "people"
        },
        {
            "name": "clap",
            "value": "\u{1f44f}",
            "category": "people"
        },
        {
            "name": "muscle",
            "value": "\u{1f4aa}",
            "category": "people"
        },
        {
            "name": "walking",
            "value": "\u{1f6b6}",
            "category": "people"
        },
        {
            "name": "runner",
            "value": "\u{1f3c3}",
            "category": "people"
        },
        {
            "name": "dancer",
            "value": "\u{1f483}",
            "category": "people"
        },
        {
            "name": "couple",
            "value": "\u{1f46b}",
            "category": "people"
        },
        {
            "name": "family",
            "value": "\u{1f46a}",
            "category": "people"
        },
        {
            "name": "two-men-holding-hands",
            "value": "\u{1f46c}",
            "category": "people"
        },
        {
            "name": "two-women-holding-hands",
            "value": "\u{1f46d}",
            "category": "people"
        },
        {
            "name": "couplekiss",
            "value": "\u{1f48f}",
            "category": "people"
        },
        {
            "name": "couple-with-heart",
            "value": "\u{1f491}",
            "category": "people"
        },
        {
            "name": "dancers",
            "value": "\u{1f46f}",
            "category": "people"
        },
        {
            "name": "ok-woman",
            "value": "\u{1f646}",
            "category": "people"
        },
        {
            "name": "no-good",
            "value": "\u{1f645}",
            "category": "people"
        },
        {
            "name": "information-desk-person",
            "value": "\u{1f481}",
            "category": "people"
        },
        {
            "name": "raised-hand",
            "value": "\u{1f64b}",
            "category": "people"
        },
        {
            "name": "massage",
            "value": "\u{1f486}",
            "category": "people"
        },
        {
            "name": "haircut",
            "value": "\u{1f487}",
            "category": "people"
        },
        {
            "name": "nail-care",
            "value": "\u{1f485}",
            "category": "people"
        },
        {
            "name": "bride-with-veil",
            "value": "\u{1f470}",
            "category": "people"
        },
        {
            "name": "person-with-pouting-face",
            "value": "\u{1f64e}",
            "category": "people"
        },
        {
            "name": "person-frowning",
            "value": "\u{1f64d}",
            "category": "people"
        },
        {
            "name": "bow",
            "value": "\u{1f647}",
            "category": "people"
        },
        {
            "name": "tophat",
            "value": "\u{1f3a9}",
            "category": "people"
        },
        {
            "name": "crown",
            "value": "\u{1f451}",
            "category": "people"
        },
        {
            "name": "womans-hat",
            "value": "\u{1f452}",
            "category": "people"
        },
        {
            "name": "athletic-shoe",
            "value": "\u{1f45f}",
            "category": "people"
        },
        {
            "name": "mans-shoe",
            "value": "\u{1f45e}",
            "category": "people"
        },
        {
            "name": "sandal",
            "value": "\u{1f461}",
            "category": "people"
        },
        {
            "name": "high-heel",
            "value": "\u{1f460}",
            "category": "people"
        },
        {
            "name": "boot",
            "value": "\u{1f462}",
            "category": "people"
        },
        {
            "name": "shirt",
            "value": "\u{1f455}",
            "category": "people"
        },
        {
            "name": "necktie",
            "value": "\u{1f454}",
            "category": "people"
        },
        {
            "name": "womans-clothes",
            "value": "\u{1f45a}",
            "category": "people"
        },
        {
            "name": "dress",
            "value": "\u{1f457}",
            "category": "people"
        },
        {
            "name": "running-shirt-with-sash",
            "value": "\u{1f3bd}",
            "category": "people"
        },
        {
            "name": "jeans",
            "value": "\u{1f456}",
            "category": "people"
        },
        {
            "name": "kimono",
            "value": "\u{1f458}",
            "category": "people"
        },
        {
            "name": "bikini",
            "value": "\u{1f459}",
            "category": "people"
        },
        {
            "name": "briefcase",
            "value": "\u{1f4bc}",
            "category": "people"
        },
        {
            "name": "handbag",
            "value": "\u{1f45c}",
            "category": "people"
        },
        {
            "name": "pouch",
            "value": "\u{1f45d}",
            "category": "people"
        },
        {
            "name": "purse",
            "value": "\u{1f45b}",
            "category": "people"
        },
        {
            "name": "eyeglasses",
            "value": "\u{1f453}",
            "category": "people"
        },
        {
            "name": "ribbon",
            "value": "\u{1f380}",
            "category": "people"
        },
        {
            "name": "closed-umbrella",
            "value": "\u{1f302}",
            "category": "people"
        },
        {
            "name": "lipstick",
            "value": "\u{1f484}",
            "category": "people"
        },
        {
            "name": "yellow-heart",
            "value": "\u{1f49b}",
            "category": "people"
        },
        {
            "name": "blue-heart",
            "value": "\u{1f499}",
            "category": "people"
        },
        {
            "name": "purple-heart",
            "value": "\u{1f49c}",
            "category": "people"
        },
        {
            "name": "green-heart",
            "value": "\u{1f49a}",
            "category": "people"
        },
        {
            "name": "heart",
            "value": "\u{2764}",
            "category": "people"
        },
        {
            "name": "broken-heart",
            "value": "\u{1f494}",
            "category": "people"
        },
        {
            "name": "heartpulse",
            "value": "\u{1f497}",
            "category": "people"
        },
        {
            "name": "heartbeat",
            "value": "\u{1f493}",
            "category": "people"
        },
        {
            "name": "two-hearts",
            "value": "\u{1f495}",
            "category": "people"
        },
        {
            "name": "sparkling-heart",
            "value": "\u{1f496}",
            "category": "people"
        },
        {
            "name": "revolving-hearts",
            "value": "\u{1f49e}",
            "category": "people"
        },
        {
            "name": "love-letter",
            "value": "\u{1f48c}",
            "category": "people"
        },
        {
            "name": "cupid",
            "value": "\u{1f498}",
            "category": "people"
        },
        {
            "name": "kiss",
            "value": "\u{1f48b}",
            "category": "people"
        },
        {
            "name": "ring",
            "value": "\u{1f48d}",
            "category": "people"
        },
        {
            "name": "gem",
            "value": "\u{1f48e}",
            "category": "people"
        },
        {
            "name": "bust-in-silhouette",
            "value": "\u{1f464}",
            "category": "people"
        },
        {
            "name": "busts-in-silhouette",
            "value": "\u{1f465}",
            "category": "people"
        },
        {
            "name": "speech-balloon",
            "value": "\u{1f4ac}",
            "category": "people"
        },
        {
            "name": "feet",
            "value": "\u{1f463}",
            "category": "people"
        },
        {
            "name": "thought-balloon",
            "value": "\u{1f4ad}",
            "category": "people"
        },
        {
            "name": "dog",
            "value": "\u{1f436}",
            "category": "nature"
        },
        {
            "name": "wolf",
            "value": "\u{1f43a}",
            "category": "nature"
        },
        {
            "name": "cat",
            "value": "\u{1f431}",
            "category": "nature"
        },
        {
            "name": "mouse",
            "value": "\u{1f42d}",
            "category": "nature"
        },
        {
            "name": "hamster",
            "value": "\u{1f439}",
            "category": "nature"
        },
        {
            "name": "rabbit",
            "value": "\u{1f430}",
            "category": "nature"
        },
        {
            "name": "frog",
            "value": "\u{1f438}",
            "category": "nature"
        },
        {
            "name": "tiger",
            "value": "\u{1f42f}",
            "category": "nature"
        },
        {
            "name": "koala",
            "value": "\u{1f428}",
            "category": "nature"
        },
        {
            "name": "bear",
            "value": "\u{1f43b}",
            "category": "nature"
        },
        {
            "name": "pig",
            "value": "\u{1f437}",
            "category": "nature"
        },
        {
            "name": "pig-nose",
            "value": "\u{1f43d}",
            "category": "nature"
        },
        {
            "name": "cow",
            "value": "\u{1f42e}",
            "category": "nature"
        },
        {
            "name": "boar",
            "value": "\u{1f417}",
            "category": "nature"
        },
        {
            "name": "monkey-face",
            "value": "\u{1f435}",
            "category": "nature"
        },
        {
            "name": "monkey",
            "value": "\u{1f412}",
            "category": "nature"
        },
        {
            "name": "horse",
            "value": "\u{1f434}",
            "category": "nature"
        },
        {
            "name": "sheep",
            "value": "\u{1f411}",
            "category": "nature"
        },
        {
            "name": "elephant",
            "value": "\u{1f418}",
            "category": "nature"
        },
        {
            "name": "panda-face",
            "value": "\u{1f43c}",
            "category": "nature"
        },
        {
            "name": "penguin",
            "value": "\u{1f427}",
            "category": "nature"
        },
        {
            "name": "bird",
            "value": "\u{1f426}",
            "category": "nature"
        },
        {
            "name": "baby-chick",
            "value": "\u{1f424}",
            "category": "nature"
        },
        {
            "name": "hatched-chick",
            "value": "\u{1f425}",
            "category": "nature"
        },
        {
            "name": "hatching-chick",
            "value": "\u{1f423}",
            "category": "nature"
        },
        {
            "name": "chicken",
            "value": "\u{1f414}",
            "category": "nature"
        },
        {
            "name": "snake",
            "value": "\u{1f40d}",
            "category": "nature"
        },
        {
            "name": "turtle",
            "value": "\u{1f422}",
            "category": "nature"
        },
        {
            "name": "bug",
            "value": "\u{1f41b}",
            "category": "nature"
        },
        {
            "name": "honeybee",
            "value": "\u{1f41d}",
            "category": "nature"
        },
        {
            "name": "ant",
            "value": "\u{1f41c}",
            "category": "nature"
        },
        {
            "name": "beetle",
            "value": "\u{1f41e}",
            "category": "nature"
        },
        {
            "name": "snail",
            "value": "\u{1f40c}",
            "category": "nature"
        },
        {
            "name": "octopus",
            "value": "\u{1f419}",
            "category": "nature"
        },
        {
            "name": "shell",
            "value": "\u{1f41a}",
            "category": "nature"
        },
        {
            "name": "tropical-fish",
            "value": "\u{1f420}",
            "category": "nature"
        },
        {
            "name": "fish",
            "value": "\u{1f41f}",
            "category": "nature"
        },
        {
            "name": "dolphin",
            "value": "\u{1f42c}",
            "category": "nature"
        },
        {
            "name": "whale",
            "value": "\u{1f433}",
            "category": "nature"
        },
        {
            "name": "whale2",
            "value": "\u{1f40b}",
            "category": "nature"
        },
        {
            "name": "cow2",
            "value": "\u{1f404}",
            "category": "nature"
        },
        {
            "name": "ram",
            "value": "\u{1f40f}",
            "category": "nature"
        },
        {
            "name": "rat",
            "value": "\u{1f400}",
            "category": "nature"
        },
        {
            "name": "water-buffalo",
            "value": "\u{1f403}",
            "category": "nature"
        },
        {
            "name": "tiger2",
            "value": "\u{1f405}",
            "category": "nature"
        },
        {
            "name": "rabbit2",
            "value": "\u{1f407}",
            "category": "nature"
        },
        {
            "name": "dragon",
            "value": "\u{1f409}",
            "category": "nature"
        },
        {
            "name": "racehorse",
            "value": "\u{1f40e}",
            "category": "nature"
        },
        {
            "name": "goat",
            "value": "\u{1f410}",
            "category": "nature"
        },
        {
            "name": "rooster",
            "value": "\u{1f413}",
            "category": "nature"
        },
        {
            "name": "dog2",
            "value": "\u{1f415}",
            "category": "nature"
        },
        {
            "name": "pig2",
            "value": "\u{1f416}",
            "category": "nature"
        },
        {
            "name": "mouse2",
            "value": "\u{1f401}",
            "category": "nature"
        },
        {
            "name": "ox",
            "value": "\u{1f402}",
            "category": "nature"
        },
        {
            "name": "dragon-face",
            "value": "\u{1f432}",
            "category": "nature"
        },
        {
            "name": "blowfish",
            "value": "\u{1f421}",
            "category": "nature"
        },
        {
            "name": "crocodile",
            "value": "\u{1f40a}",
            "category": "nature"
        },
        {
            "name": "camel",
            "value": "\u{1f42b}",
            "category": "nature"
        },
        {
            "name": "dromedary-camel",
            "value": "\u{1f42a}",
            "category": "nature"
        },
        {
            "name": "leopard",
            "value": "\u{1f406}",
            "category": "nature"
        },
        {
            "name": "cat2",
            "value": "\u{1f408}",
            "category": "nature"
        },
        {
            "name": "poodle",
            "value": "\u{1f429}",
            "category": "nature"
        },
        {
            "name": "paw-prints",
            "value": "\u{1f43e}",
            "category": "nature"
        },
        {
            "name": "bouquet",
            "value": "\u{1f490}",
            "category": "nature"
        },
        {
            "name": "cherry-blossom",
            "value": "\u{1f338}",
            "category": "nature"
        },
        {
            "name": "tulip",
            "value": "\u{1f337}",
            "category": "nature"
        },
        {
            "name": "four-leaf-clover",
            "value": "\u{1f340}",
            "category": "nature"
        },
        {
            "name": "rose",
            "value": "\u{1f339}",
            "category": "nature"
        },
        {
            "name": "sunflower",
            "value": "\u{1f33b}",
            "category": "nature"
        },
        {
            "name": "hibiscus",
            "value": "\u{1f33a}",
            "category": "nature"
        },
        {
            "name": "maple-leaf",
            "value": "\u{1f341}",
            "category": "nature"
        },
        {
            "name": "leaves",
            "value": "\u{1f343}",
            "category": "nature"
        },
        {
            "name": "fallen-leaf",
            "value": "\u{1f342}",
            "category": "nature"
        },
        {
            "name": "herb",
            "value": "\u{1f33f}",
            "category": "nature"
        },
        {
            "name": "ear-of-rice",
            "value": "\u{1f33e}",
            "category": "nature"
        },
        {
            "name": "mushroom",
            "value": "\u{1f344}",
            "category": "nature"
        },
        {
            "name": "cactus",
            "value": "\u{1f335}",
            "category": "nature"
        },
        {
            "name": "palm-tree",
            "value": "\u{1f334}",
            "category": "nature"
        },
        {
            "name": "evergreen-tree",
            "value": "\u{1f332}",
            "category": "nature"
        },
        {
            "name": "deciduous-tree",
            "value": "\u{1f333}",
            "category": "nature"
        },
        {
            "name": "chestnut",
            "value": "\u{1f330}",
            "category": "nature"
        },
        {
            "name": "seedling",
            "value": "\u{1f331}",
            "category": "nature"
        },
        {
            "name": "blossom",
            "value": "\u{1f33c}",
            "category": "nature"
        },
        {
            "name": "globe-with-meridians",
            "value": "\u{1f310}",
            "category": "nature"
        },
        {
            "name": "sun-with-face",
            "value": "\u{1f31e}",
            "category": "nature"
        },
        {
            "name": "full-moon-with-face",
            "value": "\u{1f31d}",
            "category": "nature"
        },
        {
            "name": "new-moon-with-face",
            "value": "\u{1f31a}",
            "category": "nature"
        },
        {
            "name": "new-moon",
            "value": "\u{1f311}",
            "category": "nature"
        },
        {
            "name": "waxing-crescent-moon",
            "value": "\u{1f312}",
            "category": "nature"
        },
        {
            "name": "first-quarter-moon",
            "value": "\u{1f313}",
            "category": "nature"
        },
        {
            "name": "waxing-gibbous-moon",
            "value": "\u{1f314}",
            "category": "nature"
        },
        {
            "name": "full-moon",
            "value": "\u{1f315}",
            "category": "nature"
        },
        {
            "name": "waning-gibbous-moon",
            "value": "\u{1f316}",
            "category": "nature"
        },
        {
            "name": "last-quarter-moon",
            "value": "\u{1f317}",
            "category": "nature"
        },
        {
            "name": "waning-crescent-moon",
            "value": "\u{1f318}",
            "category": "nature"
        },
        {
            "name": "last-quarter-moon-with-face",
            "value": "\u{1f31c}",
            "category": "nature"
        },
        {
            "name": "first-quarter-moon-with-face",
            "value": "\u{1f31b}",
            "category": "nature"
        },
        {
            "name": "moon",
            "value": "\u{1f319}",
            "category": "nature"
        },
        {
            "name": "earth-africa",
            "value": "\u{1f30d}",
            "category": "nature"
        },
        {
            "name": "earth-americas",
            "value": "\u{1f30e}",
            "category": "nature"
        },
        {
            "name": "earth-asia",
            "value": "\u{1f30f}",
            "category": "nature"
        },
        {
            "name": "volcano",
            "value": "\u{1f30b}",
            "category": "nature"
        },
        {
            "name": "milky-way",
            "value": "\u{1f30c}",
            "category": "nature"
        },
        {
            "name": "shooting-star",
            "value": "\u{1f320}",
            "category": "nature"
        },
        {
            "name": "star",
            "value": "\u{2b50}",
            "category": "nature"
        },
        {
            "name": "sunny",
            "value": "\u{2600}",
            "category": "nature"
        },
        {
            "name": "partly-sunny",
            "value": "\u{26c5}",
            "category": "nature"
        },
        {
            "name": "cloud",
            "value": "\u{2601}",
            "category": "nature"
        },
        {
            "name": "zap",
            "value": "\u{26a1}",
            "category": "nature"
        },
        {
            "name": "umbrella",
            "value": "\u{2614}",
            "category": "nature"
        },
        {
            "name": "snowflake",
            "value": "\u{2744}",
            "category": "nature"
        },
        {
            "name": "snowman",
            "value": "\u{26c4}",
            "category": "nature"
        },
        {
            "name": "cyclone",
            "value": "\u{1f300}",
            "category": "nature"
        },
        {
            "name": "foggy",
            "value": "\u{1f301}",
            "category": "nature"
        },
        {
            "name": "rainbow",
            "value": "\u{1f308}",
            "category": "nature"
        },
        {
            "name": "ocean",
            "value": "\u{1f30a}",
            "category": "nature"
        },
        {
            "name": "bamboo",
            "value": "\u{1f38d}",
            "category": "object"
        },
        {
            "name": "gift-heart",
            "value": "\u{1f49d}",
            "category": "object"
        },
        {
            "name": "dolls",
            "value": "\u{1f38e}",
            "category": "object"
        },
        {
            "name": "school-satchel",
            "value": "\u{1f392}",
            "category": "object"
        },
        {
            "name": "mortar-board",
            "value": "\u{1f393}",
            "category": "object"
        },
        {
            "name": "flags",
            "value": "\u{1f38f}",
            "category": "object"
        },
        {
            "name": "fireworks",
            "value": "\u{1f386}",
            "category": "object"
        },
        {
            "name": "sparkler",
            "value": "\u{1f387}",
            "category": "object"
        },
        {
            "name": "wind-chime",
            "value": "\u{1f390}",
            "category": "object"
        },
        {
            "name": "rice-scene",
            "value": "\u{1f391}",
            "category": "object"
        },
        {
            "name": "jack-o-lantern",
            "value": "\u{1f383}",
            "category": "object"
        },
        {
            "name": "ghost",
            "value": "\u{1f47b}",
            "category": "object"
        },
        {
            "name": "santa",
            "value": "\u{1f385}",
            "category": "object"
        },
        {
            "name": "christmas-tree",
            "value": "\u{1f384}",
            "category": "object"
        },
        {
            "name": "gift",
            "value": "\u{1f381}",
            "category": "object"
        },
        {
            "name": "tanabata-tree",
            "value": "\u{1f38b}",
            "category": "object"
        },
        {
            "name": "tada",
            "value": "\u{1f389}",
            "category": "object"
        },
        {
            "name": "confetti-ball",
            "value": "\u{1f38a}",
            "category": "object"
        },
        {
            "name": "balloon",
            "value": "\u{1f388}",
            "category": "object"
        },
        {
            "name": "crossed-flags",
            "value": "\u{1f38c}",
            "category": "object"
        },
        {
            "name": "crystal-ball",
            "value": "\u{1f52e}",
            "category": "object"
        },
        {
            "name": "movie-camera",
            "value": "\u{1f3a5}",
            "category": "object"
        },
        {
            "name": "camera",
            "value": "\u{1f4f7}",
            "category": "object"
        },
        {
            "name": "video-camera",
            "value": "\u{1f4f9}",
            "category": "object"
        },
        {
            "name": "vhs",
            "value": "\u{1f4fc}",
            "category": "object"
        },
        {
            "name": "cd",
            "value": "\u{1f4bf}",
            "category": "object"
        },
        {
            "name": "dvd",
            "value": "\u{1f4c0}",
            "category": "object"
        },
        {
            "name": "minidisc",
            "value": "\u{1f4bd}",
            "category": "object"
        },
        {
            "name": "floppy-disk",
            "value": "\u{1f4be}",
            "category": "object"
        },
        {
            "name": "computer",
            "value": "\u{1f4bb}",
            "category": "object"
        },
        {
            "name": "iphone",
            "value": "\u{1f4f1}",
            "category": "object"
        },
        {
            "name": "phone",
            "value": "\u{260e}",
            "category": "object"
        },
        {
            "name": "telephone-receiver",
            "value": "\u{1f4de}",
            "category": "object"
        },
        {
            "name": "pager",
            "value": "\u{1f4df}",
            "category": "object"
        },
        {
            "name": "fax",
            "value": "\u{1f4e0}",
            "category": "object"
        },
        {
            "name": "satellite",
            "value": "\u{1f4e1}",
            "category": "object"
        },
        {
            "name": "tv",
            "value": "\u{1f4fa}",
            "category": "object"
        },
        {
            "name": "radio",
            "value": "\u{1f4fb}",
            "category": "object"
        },
        {
            "name": "speaker-waves",
            "value": "\u{1f50a}",
            "category": "object"
        },
        {
            "name": "sound",
            "value": "\u{1f509}",
            "category": "object"
        },
        {
            "name": "speaker",
            "value": "\u{1f508}",
            "category": "object"
        },
        {
            "name": "mute",
            "value": "\u{1f507}",
            "category": "object"
        },
        {
            "name": "bell",
            "value": "\u{1f514}",
            "category": "object"
        },
        {
            "name": "no-bell",
            "value": "\u{1f515}",
            "category": "object"
        },
        {
            "name": "loudspeaker",
            "value": "\u{1f4e2}",
            "category": "object"
        },
        {
            "name": "mega",
            "value": "\u{1f4e3}",
            "category": "object"
        },
        {
            "name": "hourglass-flowing-sand",
            "value": "\u{23f3}",
            "category": "object"
        },
        {
            "name": "hourglass",
            "value": "\u{231b}",
            "category": "object"
        },
        {
            "name": "alarm-clock",
            "value": "\u{23f0}",
            "category": "object"
        },
        {
            "name": "watch",
            "value": "\u{231a}",
            "category": "object"
        },
        {
            "name": "unlock",
            "value": "\u{1f513}",
            "category": "object"
        },
        {
            "name": "lock",
            "value": "\u{1f512}",
            "category": "object"
        },
        {
            "name": "lock-with-ink-pen",
            "value": "\u{1f50f}",
            "category": "object"
        },
        {
            "name": "closed-lock-with-key",
            "value": "\u{1f510}",
            "category": "object"
        },
        {
            "name": "key",
            "value": "\u{1f511}",
            "category": "object"
        },
        {
            "name": "mag-right",
            "value": "\u{1f50e}",
            "category": "object"
        },
        {
            "name": "bulb",
            "value": "\u{1f4a1}",
            "category": "object"
        },
        {
            "name": "flashlight",
            "value": "\u{1f526}",
            "category": "object"
        },
        {
            "name": "high-brightness",
            "value": "\u{1f506}",
            "category": "object"
        },
        {
            "name": "low-brightness",
            "value": "\u{1f505}",
            "category": "object"
        },
        {
            "name": "electric-plug",
            "value": "\u{1f50c}",
            "category": "object"
        },
        {
            "name": "battery",
            "value": "\u{1f50b}",
            "category": "object"
        },
        {
            "name": "mag",
            "value": "\u{1f50d}",
            "category": "object"
        },
        {
            "name": "bathtub",
            "value": "\u{1f6c1}",
            "category": "object"
        },
        {
            "name": "bath",
            "value": "\u{1f6c0}",
            "category": "object"
        },
        {
            "name": "shower",
            "value": "\u{1f6bf}",
            "category": "object"
        },
        {
            "name": "toilet",
            "value": "\u{1f6bd}",
            "category": "object"
        },
        {
            "name": "wrench",
            "value": "\u{1f527}",
            "category": "object"
        },
        {
            "name": "nut-and-bolt",
            "value": "\u{1f529}",
            "category": "object"
        },
        {
            "name": "hammer",
            "value": "\u{1f528}",
            "category": "object"
        },
        {
            "name": "door",
            "value": "\u{1f6aa}",
            "category": "object"
        },
        {
            "name": "smoking",
            "value": "\u{1f6ac}",
            "category": "object"
        },
        {
            "name": "bomb",
            "value": "\u{1f4a3}",
            "category": "object"
        },
        {
            "name": "gun",
            "value": "\u{1f52b}",
            "category": "object"
        },
        {
            "name": "hocho",
            "value": "\u{1f52a}",
            "category": "object"
        },
        {
            "name": "pill",
            "value": "\u{1f48a}",
            "category": "object"
        },
        {
            "name": "syringe",
            "value": "\u{1f489}",
            "category": "object"
        },
        {
            "name": "moneybag",
            "value": "\u{1f4b0}",
            "category": "object"
        },
        {
            "name": "yen",
            "value": "\u{1f4b4}",
            "category": "object"
        },
        {
            "name": "dollar",
            "value": "\u{1f4b5}",
            "category": "object"
        },
        {
            "name": "pound",
            "value": "\u{1f4b7}",
            "category": "object"
        },
        {
            "name": "euro",
            "value": "\u{1f4b6}",
            "category": "object"
        },
        {
            "name": "credit-card",
            "value": "\u{1f4b3}",
            "category": "object"
        },
        {
            "name": "money-with-wings",
            "value": "\u{1f4b8}",
            "category": "object"
        },
        {
            "name": "calling",
            "value": "\u{1f4f2}",
            "category": "object"
        },
        {
            "name": "e-mail",
            "value": "\u{1f4e7}",
            "category": "object"
        },
        {
            "name": "inbox-tray",
            "value": "\u{1f4e5}",
            "category": "object"
        },
        {
            "name": "outbox-tray",
            "value": "\u{1f4e4}",
            "category": "object"
        },
        {
            "name": "email",
            "value": "\u{2709}",
            "category": "object"
        },
        {
            "name": "enveloppe",
            "value": "\u{1f4e9}",
            "category": "object"
        },
        {
            "name": "incoming-envelope",
            "value": "\u{1f4e8}",
            "category": "object"
        },
        {
            "name": "postal-horn",
            "value": "\u{1f4ef}",
            "category": "object"
        },
        {
            "name": "mailbox",
            "value": "\u{1f4eb}",
            "category": "object"
        },
        {
            "name": "mailbox-closed",
            "value": "\u{1f4ea}",
            "category": "object"
        },
        {
            "name": "mailbox-with-mail",
            "value": "\u{1f4ec}",
            "category": "object"
        },
        {
            "name": "mailbox-with-no-mail",
            "value": "\u{1f4ed}",
            "category": "object"
        },
        {
            "name": "postbox",
            "value": "\u{1f4ee}",
            "category": "object"
        },
        {
            "name": "package",
            "value": "\u{1f4e6}",
            "category": "object"
        },
        {
            "name": "memo",
            "value": "\u{1f4dd}",
            "category": "object"
        },
        {
            "name": "page-facing-up",
            "value": "\u{1f4c4}",
            "category": "object"
        },
        {
            "name": "page-with-curl",
            "value": "\u{1f4c3}",
            "category": "object"
        },
        {
            "name": "bookmark-tabs",
            "value": "\u{1f4d1}",
            "category": "object"
        },
        {
            "name": "bar-chart",
            "value": "\u{1f4ca}",
            "category": "object"
        },
        {
            "name": "chart-with-upwards-trend",
            "value": "\u{1f4c8}",
            "category": "object"
        },
        {
            "name": "chart-with-downwards-trend",
            "value": "\u{1f4c9}",
            "category": "object"
        },
        {
            "name": "scroll",
            "value": "\u{1f4dc}",
            "category": "object"
        },
        {
            "name": "clipboard",
            "value": "\u{1f4cb}",
            "category": "object"
        },
        {
            "name": "date",
            "value": "\u{1f4c5}",
            "category": "object"
        },
        {
            "name": "calendar",
            "value": "\u{1f4c6}",
            "category": "object"
        },
        {
            "name": "card-index",
            "value": "\u{1f4c7}",
            "category": "object"
        },
        {
            "name": "file-folder",
            "value": "\u{1f4c1}",
            "category": "object"
        },
        {
            "name": "open-file-folder",
            "value": "\u{1f4c2}",
            "category": "object"
        },
        {
            "name": "scissors",
            "value": "\u{2702}",
            "category": "object"
        },
        {
            "name": "pushpin",
            "value": "\u{1f4cc}",
            "category": "object"
        },
        {
            "name": "paperclip",
            "value": "\u{1f4ce}",
            "category": "object"
        },
        {
            "name": "black-nib",
            "value": "\u{2712}",
            "category": "object"
        },
        {
            "name": "pencil2",
            "value": "\u{270f}",
            "category": "object"
        },
        {
            "name": "straight-ruler",
            "value": "\u{1f4cf}",
            "category": "object"
        },
        {
            "name": "triangular-ruler",
            "value": "\u{1f4d0}",
            "category": "object"
        },
        {
            "name": "closed-book",
            "value": "\u{1f4d5}",
            "category": "object"
        },
        {
            "name": "green-book",
            "value": "\u{1f4d7}",
            "category": "object"
        },
        {
            "name": "blue-book",
            "value": "\u{1f4d8}",
            "category": "object"
        },
        {
            "name": "orange-book",
            "value": "\u{1f4d9}",
            "category": "object"
        },
        {
            "name": "notebook",
            "value": "\u{1f4d3}",
            "category": "object"
        },
        {
            "name": "notebook-with-decorative-cover",
            "value": "\u{1f4d4}",
            "category": "object"
        },
        {
            "name": "ledger",
            "value": "\u{1f4d2}",
            "category": "object"
        },
        {
            "name": "books",
            "value": "\u{1f4da}",
            "category": "object"
        },
        {
            "name": "open-book",
            "value": "\u{1f4d6}",
            "category": "object"
        },
        {
            "name": "bookmark",
            "value": "\u{1f516}",
            "category": "object"
        },
        {
            "name": "name-badge",
            "value": "\u{1f4db}",
            "category": "object"
        },
        {
            "name": "microscope",
            "value": "\u{1f52c}",
            "category": "object"
        },
        {
            "name": "telescope",
            "value": "\u{1f52d}",
            "category": "object"
        },
        {
            "name": "newspaper",
            "value": "\u{1f4f0}",
            "category": "object"
        },
        {
            "name": "art",
            "value": "\u{1f3a8}",
            "category": "object"
        },
        {
            "name": "clapper",
            "value": "\u{1f3ac}",
            "category": "object"
        },
        {
            "name": "microphone",
            "value": "\u{1f3a4}",
            "category": "object"
        },
        {
            "name": "headphones",
            "value": "\u{1f3a7}",
            "category": "object"
        },
        {
            "name": "musical-score",
            "value": "\u{1f3bc}",
            "category": "object"
        },
        {
            "name": "musical-note",
            "value": "\u{1f3b5}",
            "category": "object"
        },
        {
            "name": "notes",
            "value": "\u{1f3b6}",
            "category": "object"
        },
        {
            "name": "musical-keyboard",
            "value": "\u{1f3b9}",
            "category": "object"
        },
        {
            "name": "violin",
            "value": "\u{1f3bb}",
            "category": "object"
        },
        {
            "name": "trumpet",
            "value": "\u{1f3ba}",
            "category": "object"
        },
        {
            "name": "saxophone",
            "value": "\u{1f3b7}",
            "category": "object"
        },
        {
            "name": "guitar",
            "value": "\u{1f3b8}",
            "category": "object"
        },
        {
            "name": "space-invader",
            "value": "\u{1f47e}",
            "category": "object"
        },
        {
            "name": "video-game",
            "value": "\u{1f3ae}",
            "category": "object"
        },
        {
            "name": "black-joker",
            "value": "\u{1f0cf}",
            "category": "object"
        },
        {
            "name": "flower-playing-cards",
            "value": "\u{1f3b4}",
            "category": "object"
        },
        {
            "name": "mahjong",
            "value": "\u{1f004}",
            "category": "object"
        },
        {
            "name": "game-die",
            "value": "\u{1f3b2}",
            "category": "object"
        },
        {
            "name": "dart",
            "value": "\u{1f3af}",
            "category": "object"
        },
        {
            "name": "football",
            "value": "\u{1f3c8}",
            "category": "object"
        },
        {
            "name": "basketball",
            "value": "\u{1f3c0}",
            "category": "object"
        },
        {
            "name": "soccer",
            "value": "\u{26bd}",
            "category": "object"
        },
        {
            "name": "baseball",
            "value": "\u{26be}",
            "category": "object"
        },
        {
            "name": "tennis",
            "value": "\u{1f3be}",
            "category": "object"
        },
        {
            "name": "8ball",
            "value": "\u{1f3b1}",
            "category": "object"
        },
        {
            "name": "rugby-football",
            "value": "\u{1f3c9}",
            "category": "object"
        },
        {
            "name": "bowling",
            "value": "\u{1f3b3}",
            "category": "object"
        },
        {
            "name": "golf",
            "value": "\u{26f3}",
            "category": "object"
        },
        {
            "name": "mountain-bicyclist",
            "value": "\u{1f6b5}",
            "category": "object"
        },
        {
            "name": "bicyclist",
            "value": "\u{1f6b4}",
            "category": "object"
        },
        {
            "name": "checkered-flag",
            "value": "\u{1f3c1}",
            "category": "object"
        },
        {
            "name": "horse-racing",
            "value": "\u{1f3c7}",
            "category": "object"
        },
        {
            "name": "trophy",
            "value": "\u{1f3c6}",
            "category": "object"
        },
        {
            "name": "ski",
            "value": "\u{1f3bf}",
            "category": "object"
        },
        {
            "name": "snowboarder",
            "value": "\u{1f3c2}",
            "category": "object"
        },
        {
            "name": "swimmer",
            "value": "\u{1f3ca}",
            "category": "object"
        },
        {
            "name": "surfer",
            "value": "\u{1f3c4}",
            "category": "object"
        },
        {
            "name": "fishing-pole-and-fish",
            "value": "\u{1f3a3}",
            "category": "object"
        },
        {
            "name": "coffee",
            "value": "\u{2615}",
            "category": "object"
        },
        {
            "name": "tea",
            "value": "\u{1f375}",
            "category": "object"
        },
        {
            "name": "sake",
            "value": "\u{1f376}",
            "category": "object"
        },
        {
            "name": "baby-bottle",
            "value": "\u{1f37c}",
            "category": "object"
        },
        {
            "name": "beer",
            "value": "\u{1f37a}",
            "category": "object"
        },
        {
            "name": "beers",
            "value": "\u{1f37b}",
            "category": "object"
        },
        {
            "name": "cocktail",
            "value": "\u{1f378}",
            "category": "object"
        },
        {
            "name": "tropical-drink",
            "value": "\u{1f379}",
            "category": "object"
        },
        {
            "name": "wine-glass",
            "value": "\u{1f377}",
            "category": "object"
        },
        {
            "name": "fork-and-knife",
            "value": "\u{1f374}",
            "category": "object"
        },
        {
            "name": "pizza",
            "value": "\u{1f355}",
            "category": "object"
        },
        {
            "name": "hamburger",
            "value": "\u{1f354}",
            "category": "object"
        },
        {
            "name": "fries",
            "value": "\u{1f35f}",
            "category": "object"
        },
        {
            "name": "poultry-leg",
            "value": "\u{1f357}",
            "category": "object"
        },
        {
            "name": "meat-on-bone",
            "value": "\u{1f356}",
            "category": "object"
        },
        {
            "name": "spaghetti",
            "value": "\u{1f35d}",
            "category": "object"
        },
        {
            "name": "curry",
            "value": "\u{1f35b}",
            "category": "object"
        },
        {
            "name": "fried-shrimp",
            "value": "\u{1f364}",
            "category": "object"
        },
        {
            "name": "bento",
            "value": "\u{1f371}",
            "category": "object"
        },
        {
            "name": "sushi",
            "value": "\u{1f363}",
            "category": "object"
        },
        {
            "name": "fish-cake",
            "value": "\u{1f365}",
            "category": "object"
        },
        {
            "name": "rice-ball",
            "value": "\u{1f359}",
            "category": "object"
        },
        {
            "name": "rice-cracker",
            "value": "\u{1f358}",
            "category": "object"
        },
        {
            "name": "rice",
            "value": "\u{1f35a}",
            "category": "object"
        },
        {
            "name": "ramen",
            "value": "\u{1f35c}",
            "category": "object"
        },
        {
            "name": "stew",
            "value": "\u{1f372}",
            "category": "object"
        },
        {
            "name": "oden",
            "value": "\u{1f362}",
            "category": "object"
        },
        {
            "name": "dango",
            "value": "\u{1f361}",
            "category": "object"
        },
        {
            "name": "egg",
            "value": "\u{1f373}",
            "category": "object"
        },
        {
            "name": "bread",
            "value": "\u{1f35e}",
            "category": "object"
        },
        {
            "name": "doughnut",
            "value": "\u{1f369}",
            "category": "object"
        },
        {
            "name": "custard",
            "value": "\u{1f36e}",
            "category": "object"
        },
        {
            "name": "icecream",
            "value": "\u{1f366}",
            "category": "object"
        },
        {
            "name": "ice-cream",
            "value": "\u{1f368}",
            "category": "object"
        },
        {
            "name": "shaved-ice",
            "value": "\u{1f367}",
            "category": "object"
        },
        {
            "name": "birthday",
            "value": "\u{1f382}",
            "category": "object"
        },
        {
            "name": "cake",
            "value": "\u{1f370}",
            "category": "object"
        },
        {
            "name": "cookie",
            "value": "\u{1f36a}",
            "category": "object"
        },
        {
            "name": "chocolate-bar",
            "value": "\u{1f36b}",
            "category": "object"
        },
        {
            "name": "candy",
            "value": "\u{1f36c}",
            "category": "object"
        },
        {
            "name": "lollipop",
            "value": "\u{1f36d}",
            "category": "object"
        },
        {
            "name": "honey-pot",
            "value": "\u{1f36f}",
            "category": "object"
        },
        {
            "name": "apple",
            "value": "\u{1f34e}",
            "category": "object"
        },
        {
            "name": "green-apple",
            "value": "\u{1f34f}",
            "category": "object"
        },
        {
            "name": "tangerine",
            "value": "\u{1f34a}",
            "category": "object"
        },
        {
            "name": "lemon",
            "value": "\u{1f34b}",
            "category": "object"
        },
        {
            "name": "cherries",
            "value": "\u{1f352}",
            "category": "object"
        },
        {
            "name": "grapes",
            "value": "\u{1f347}",
            "category": "object"
        },
        {
            "name": "watermelon",
            "value": "\u{1f349}",
            "category": "object"
        },
        {
            "name": "strawberry",
            "value": "\u{1f353}",
            "category": "object"
        },
        {
            "name": "peach",
            "value": "\u{1f351}",
            "category": "object"
        },
        {
            "name": "melon",
            "value": "\u{1f348}",
            "category": "object"
        },
        {
            "name": "banana",
            "value": "\u{1f34c}",
            "category": "object"
        },
        {
            "name": "pear",
            "value": "\u{1f350}",
            "category": "object"
        },
        {
            "name": "pineapple",
            "value": "\u{1f34d}",
            "category": "object"
        },
        {
            "name": "sweet-potato",
            "value": "\u{1f360}",
            "category": "object"
        },
        {
            "name": "eggplant",
            "value": "\u{1f346}",
            "category": "object"
        },
        {
            "name": "tomato",
            "value": "\u{1f345}",
            "category": "object"
        },
        {
            "name": "corn",
            "value": "\u{1f33d}",
            "category": "object"
        },
        {
            "name": "house",
            "value": "\u{1f3e0}",
            "category": "place"
        },
        {
            "name": "house-with-garden",
            "value": "\u{1f3e1}",
            "category": "place"
        },
        {
            "name": "school",
            "value": "\u{1f3eb}",
            "category": "place"
        },
        {
            "name": "office",
            "value": "\u{1f3e2}",
            "category": "place"
        },
        {
            "name": "post-office",
            "value": "\u{1f3e3}",
            "category": "place"
        },
        {
            "name": "hospital",
            "value": "\u{1f3e5}",
            "category": "place"
        },
        {
            "name": "bank",
            "value": "\u{1f3e6}",
            "category": "place"
        },
        {
            "name": "convenience-store",
            "value": "\u{1f3ea}",
            "category": "place"
        },
        {
            "name": "love-hotel",
            "value": "\u{1f3e9}",
            "category": "place"
        },
        {
            "name": "hotel",
            "value": "\u{1f3e8}",
            "category": "place"
        },
        {
            "name": "wedding",
            "value": "\u{1f492}",
            "category": "place"
        },
        {
            "name": "church",
            "value": "\u{26ea}",
            "category": "place"
        },
        {
            "name": "department-store",
            "value": "\u{1f3ec}",
            "category": "place"
        },
        {
            "name": "european-post-office",
            "value": "\u{1f3e4}",
            "category": "place"
        },
        {
            "name": "private-use",
            "value": "\u{e50a}",
            "category": "place"
        },
        {
            "name": "city-sunrise",
            "value": "\u{1f307}",
            "category": "place"
        },
        {
            "name": "city-sunset",
            "value": "\u{1f306}",
            "category": "place"
        },
        {
            "name": "japanese-castle",
            "value": "\u{1f3ef}",
            "category": "place"
        },
        {
            "name": "european-castle",
            "value": "\u{1f3f0}",
            "category": "place"
        },
        {
            "name": "tent",
            "value": "\u{26fa}",
            "category": "place"
        },
        {
            "name": "factory",
            "value": "\u{1f3ed}",
            "category": "place"
        },
        {
            "name": "tokyo-tower",
            "value": "\u{1f5fc}",
            "category": "place"
        },
        {
            "name": "japan",
            "value": "\u{1f5fe}",
            "category": "place"
        },
        {
            "name": "mount-fuji",
            "value": "\u{1f5fb}",
            "category": "place"
        },
        {
            "name": "sunrise-over-mountains",
            "value": "\u{1f304}",
            "category": "place"
        },
        {
            "name": "sunrise",
            "value": "\u{1f305}",
            "category": "place"
        },
        {
            "name": "stars",
            "value": "\u{1f303}",
            "category": "place"
        },
        {
            "name": "statue-of-liberty",
            "value": "\u{1f5fd}",
            "category": "place"
        },
        {
            "name": "bridge-at-night",
            "value": "\u{1f309}",
            "category": "place"
        },
        {
            "name": "carousel-horse",
            "value": "\u{1f3a0}",
            "category": "place"
        },
        {
            "name": "ferris-wheel",
            "value": "\u{1f3a1}",
            "category": "place"
        },
        {
            "name": "fountain",
            "value": "\u{26f2}",
            "category": "place"
        },
        {
            "name": "roller-coaster",
            "value": "\u{1f3a2}",
            "category": "place"
        },
        {
            "name": "ship",
            "value": "\u{1f6a2}",
            "category": "place"
        },
        {
            "name": "boat",
            "value": "\u{26f5}",
            "category": "place"
        },
        {
            "name": "speedboat",
            "value": "\u{1f6a4}",
            "category": "place"
        },
        {
            "name": "rowboat",
            "value": "\u{1f6a3}",
            "category": "place"
        },
        {
            "name": "anchor",
            "value": "\u{2693}",
            "category": "place"
        },
        {
            "name": "rocket",
            "value": "\u{1f680}",
            "category": "place"
        },
        {
            "name": "airplane",
            "value": "\u{2708}",
            "category": "place"
        },
        {
            "name": "seat",
            "value": "\u{1f4ba}",
            "category": "place"
        },
        {
            "name": "helicopter",
            "value": "\u{1f681}",
            "category": "place"
        },
        {
            "name": "steam-locomotive",
            "value": "\u{1f682}",
            "category": "place"
        },
        {
            "name": "tram",
            "value": "\u{1f68a}",
            "category": "place"
        },
        {
            "name": "station",
            "value": "\u{1f689}",
            "category": "place"
        },
        {
            "name": "mountain-railway",
            "value": "\u{1f69e}",
            "category": "place"
        },
        {
            "name": "train2",
            "value": "\u{1f686}",
            "category": "place"
        },
        {
            "name": "bullettrain-side",
            "value": "\u{1f684}",
            "category": "place"
        },
        {
            "name": "bullettrain-front",
            "value": "\u{1f685}",
            "category": "place"
        },
        {
            "name": "light-rail",
            "value": "\u{1f688}",
            "category": "place"
        },
        {
            "name": "metro",
            "value": "\u{1f687}",
            "category": "place"
        },
        {
            "name": "monorail",
            "value": "\u{1f69d}",
            "category": "place"
        },
        {
            "name": "tram-car",
            "value": "\u{1f68b}",
            "category": "place"
        },
        {
            "name": "railway-car",
            "value": "\u{1f683}",
            "category": "place"
        },
        {
            "name": "trolleybus",
            "value": "\u{1f68e}",
            "category": "place"
        },
        {
            "name": "bus",
            "value": "\u{1f68c}",
            "category": "place"
        },
        {
            "name": "oncoming-bus",
            "value": "\u{1f68d}",
            "category": "place"
        },
        {
            "name": "blue-car",
            "value": "\u{1f699}",
            "category": "place"
        },
        {
            "name": "oncoming-automobile",
            "value": "\u{1f698}",
            "category": "place"
        },
        {
            "name": "car",
            "value": "\u{1f697}",
            "category": "place"
        },
        {
            "name": "taxi",
            "value": "\u{1f695}",
            "category": "place"
        },
        {
            "name": "oncoming-taxi",
            "value": "\u{1f696}",
            "category": "place"
        },
        {
            "name": "articulated-lorry",
            "value": "\u{1f69b}",
            "category": "place"
        },
        {
            "name": "truck",
            "value": "\u{1f69a}",
            "category": "place"
        },
        {
            "name": "rotating-light",
            "value": "\u{1f6a8}",
            "category": "place"
        },
        {
            "name": "police-car",
            "value": "\u{1f693}",
            "category": "place"
        },
        {
            "name": "oncoming-police-car",
            "value": "\u{1f694}",
            "category": "place"
        },
        {
            "name": "fire-engine",
            "value": "\u{1f692}",
            "category": "place"
        },
        {
            "name": "ambulance",
            "value": "\u{1f691}",
            "category": "place"
        },
        {
            "name": "minibus",
            "value": "\u{1f690}",
            "category": "place"
        },
        {
            "name": "bike",
            "value": "\u{1f6b2}",
            "category": "place"
        },
        {
            "name": "aerial-tramway",
            "value": "\u{1f6a1}",
            "category": "place"
        },
        {
            "name": "suspension-railway",
            "value": "\u{1f69f}",
            "category": "place"
        },
        {
            "name": "mountain-cableway",
            "value": "\u{1f6a0}",
            "category": "place"
        },
        {
            "name": "tractor",
            "value": "\u{1f69c}",
            "category": "place"
        },
        {
            "name": "barber",
            "value": "\u{1f488}",
            "category": "place"
        },
        {
            "name": "busstop",
            "value": "\u{1f68f}",
            "category": "place"
        },
        {
            "name": "ticket",
            "value": "\u{1f3ab}",
            "category": "place"
        },
        {
            "name": "vertical-traffic-light",
            "value": "\u{1f6a6}",
            "category": "place"
        },
        {
            "name": "traffic-light",
            "value": "\u{1f6a5}",
            "category": "place"
        },
        {
            "name": "warning",
            "value": "\u{26a0}",
            "category": "place"
        },
        {
            "name": "construction",
            "value": "\u{1f6a7}",
            "category": "place"
        },
        {
            "name": "beginner",
            "value": "\u{1f530}",
            "category": "place"
        },
        {
            "name": "fuelpump",
            "value": "\u{26fd}",
            "category": "place"
        },
        {
            "name": "izakaya-lantern",
            "value": "\u{1f3ee}",
            "category": "place"
        },
        {
            "name": "slot-machine",
            "value": "\u{1f3b0}",
            "category": "place"
        },
        {
            "name": "hotsprings",
            "value": "\u{2668}",
            "category": "place"
        },
        {
            "name": "moyai",
            "value": "\u{1f5ff}",
            "category": "place"
        },
        {
            "name": "circus-tent",
            "value": "\u{1f3aa}",
            "category": "place"
        },
        {
            "name": "performing-arts",
            "value": "\u{1f3ad}",
            "category": "place"
        },
        {
            "name": "round-pushpin",
            "value": "\u{1f4cd}",
            "category": "place"
        },
        {
            "name": "triangular-flag-on-post",
            "value": "\u{1f6a9}",
            "category": "place"
        },
        {
            "name": "cn",
            "value": "\u{1f1e8}\u{1f1f3}",
            "category": "place"
        },
        {
            "name": "de",
            "value": "\u{1f1e9}\u{1f1ea}",
            "category": "place"
        },
        {
            "name": "es",
            "value": "\u{1f1ea}\u{1f1f8}",
            "category": "place"
        },
        {
            "name": "fr",
            "value": "\u{1f1eb}\u{1f1f7}",
            "category": "place"
        },
        {
            "name": "gb",
            "value": "\u{1f1ec}\u{1f1e7}",
            "category": "place"
        },
        {
            "name": "it",
            "value": "\u{1f1ee}\u{1f1f9}",
            "category": "place"
        },
        {
            "name": "jp",
            "value": "\u{1f1ef}\u{1f1f5}",
            "category": "place"
        },
        {
            "name": "kr",
            "value": "\u{1f1f0}\u{1f1f7}",
            "category": "place"
        },
        {
            "name": "ru",
            "value": "\u{1f1f7}\u{1f1fa}",
            "category": "place"
        },
        {
            "name": "us",
            "value": "\u{1f1fa}\u{1f1f8}",
            "category": "place"
        },
        {
            "name": "one",
            "value": "\u{31}\u{20e3}",
            "category": "symbol"
        },
        {
            "name": "two",
            "value": "\u{32}\u{20e3}",
            "category": "symbol"
        },
        {
            "name": "three",
            "value": "\u{33}\u{20e3}",
            "category": "symbol"
        },
        {
            "name": "four",
            "value": "\u{34}\u{20e3}",
            "category": "symbol"
        },
        {
            "name": "five",
            "value": "\u{35}\u{20e3}",
            "category": "symbol"
        },
        {
            "name": "six",
            "value": "\u{36}\u{20e3}",
            "category": "symbol"
        },
        {
            "name": "seve",
            "value": "\u{37}\u{20e3}",
            "category": "symbol"
        },
        {
            "name": "eight",
            "value": "\u{38}\u{20e3}",
            "category": "symbol"
        },
        {
            "name": "nine",
            "value": "\u{39}\u{20e3}",
            "category": "symbol"
        },
        {
            "name": "zero",
            "value": "\u{30}\u{20e3}",
            "category": "symbol"
        },
        {
            "name": "keycap-ten",
            "value": "\u{1f51f}",
            "category": "symbol"
        },
        {
            "name": "1234",
            "value": "\u{1f522}",
            "category": "symbol"
        },
        {
            "name": "hash",
            "value": "\u{23}\u{20e3}",
            "category": "symbol"
        },
        {
            "name": "symbols",
            "value": "\u{1f523}",
            "category": "symbol"
        },
        {
            "name": "capital-abcd",
            "value": "\u{1f520}",
            "category": "symbol"
        },
        {
            "name": "abcd",
            "value": "\u{1f521}",
            "category": "symbol"
        },
        {
            "name": "abc",
            "value": "\u{1f524}",
            "category": "symbol"
        },
        {
            "name": "letter-a",
            "value": "\u{1f1e6}",
            "category": "symbol"
        },
        {
            "name": "letter-b",
            "value": "\u{1f1e7}",
            "category": "symbol"
        },
        {
            "name": "letter-c",
            "value": "\u{1f1e8}",
            "category": "symbol"
        },
        {
            "name": "letter-d",
            "value": "\u{1f1e9}",
            "category": "symbol"
        },
        {
            "name": "letter-e",
            "value": "\u{1f1ea}",
            "category": "symbol"
        },
        {
            "name": "letter-f",
            "value": "\u{1f1eb}",
            "category": "symbol"
        },
        {
            "name": "letter-g",
            "value": "\u{1f1ec}",
            "category": "symbol"
        },
        {
            "name": "letter-h",
            "value": "\u{1f1ed}",
            "category": "symbol"
        },
        {
            "name": "letter-i",
            "value": "\u{1f1ee}",
            "category": "symbol"
        },
        {
            "name": "letter-j",
            "value": "\u{1f1ef}",
            "category": "symbol"
        },
        {
            "name": "letter-k",
            "value": "\u{1f1f0}",
            "category": "symbol"
        },
        {
            "name": "letter-l",
            "value": "\u{1f1f1}",
            "category": "symbol"
        },
        {
            "name": "letter-m",
            "value": "\u{1f1f2}",
            "category": "symbol"
        },
        {
            "name": "letter-n",
            "value": "\u{1f1f3}",
            "category": "symbol"
        },
        {
            "name": "letter-o",
            "value": "\u{1f1f4}",
            "category": "symbol"
        },
        {
            "name": "letter-p",
            "value": "\u{1f1f5}",
            "category": "symbol"
        },
        {
            "name": "letter-q",
            "value": "\u{1f1f6}",
            "category": "symbol"
        },
        {
            "name": "letter-r",
            "value": "\u{1f1f7}",
            "category": "symbol"
        },
        {
            "name": "letter-s",
            "value": "\u{1f1f8}",
            "category": "symbol"
        },
        {
            "name": "letter-t",
            "value": "\u{1f1f9}",
            "category": "symbol"
        },
        {
            "name": "letter-u",
            "value": "\u{1f1fa}",
            "category": "symbol"
        },
        {
            "name": "letter-v",
            "value": "\u{1f1fb}",
            "category": "symbol"
        },
        {
            "name": "letter-w",
            "value": "\u{1f1fc}",
            "category": "symbol"
        },
        {
            "name": "letter-x",
            "value": "\u{1f1fd}",
            "category": "symbol"
        },
        {
            "name": "letter-y",
            "value": "\u{1f1fe}",
            "category": "symbol"
        },
        {
            "name": "letter-z",
            "value": "\u{1f1ff}",
            "category": "symbol"
        },
        {
            "name": "arrow-up",
            "value": "\u{2b06}",
            "category": "symbol"
        },
        {
            "name": "arrow-down",
            "value": "\u{2b07}",
            "category": "symbol"
        },
        {
            "name": "arrow-left",
            "value": "\u{2b05}",
            "category": "symbol"
        },
        {
            "name": "arrow-right",
            "value": "\u{27a1}",
            "category": "symbol"
        },
        {
            "name": "arrow-upper-left",
            "value": "\u{2196}",
            "category": "symbol"
        },
        {
            "name": "arrow-upper-right",
            "value": "\u{2197}",
            "category": "symbol"
        },
        {
            "name": "arrow-lower-right",
            "value": "\u{2198}",
            "category": "symbol"
        },
        {
            "name": "arrow-lower-left",
            "value": "\u{2199}",
            "category": "symbol"
        },
        {
            "name": "left-right-arrow",
            "value": "\u{2194}",
            "category": "symbol"
        },
        {
            "name": "arrow-up-down",
            "value": "\u{2195}",
            "category": "symbol"
        },
        {
            "name": "arrows-counterclockwise",
            "value": "\u{1f504}",
            "category": "symbol"
        },
        {
            "name": "arrow-backward",
            "value": "\u{25c0}",
            "category": "symbol"
        },
        {
            "name": "arrow-forward",
            "value": "\u{25b6}",
            "category": "symbol"
        },
        {
            "name": "arrow-up-small",
            "value": "\u{1f53c}",
            "category": "symbol"
        },
        {
            "name": "arrow-down-small",
            "value": "\u{1f53d}",
            "category": "symbol"
        },
        {
            "name": "leftwards-arrow-with-hook",
            "value": "\u{21a9}",
            "category": "symbol"
        },
        {
            "name": "arrow-right-hook",
            "value": "\u{21aa}",
            "category": "symbol"
        },
        {
            "name": "information-source",
            "value": "\u{2139}",
            "category": "symbol"
        },
        {
            "name": "rewind",
            "value": "\u{23ea}",
            "category": "symbol"
        },
        {
            "name": "fast-forward",
            "value": "\u{23e9}",
            "category": "symbol"
        },
        {
            "name": "arrow-double-up",
            "value": "\u{23eb}",
            "category": "symbol"
        },
        {
            "name": "arrow-double-down",
            "value": "\u{23ec}",
            "category": "symbol"
        },
        {
            "name": "arrow-heading-down",
            "value": "\u{2935}",
            "category": "symbol"
        },
        {
            "name": "arrow-heading-up",
            "value": "\u{2934}",
            "category": "symbol"
        },
        {
            "name": "ok",
            "value": "\u{1f197}",
            "category": "symbol"
        },
        {
            "name": "twisted-rightwards-arrows",
            "value": "\u{1f500}",
            "category": "symbol"
        },
        {
            "name": "repeat",
            "value": "\u{1f501}",
            "category": "symbol"
        },
        {
            "name": "repeat-one",
            "value": "\u{1f502}",
            "category": "symbol"
        },
        {
            "name": "new",
            "value": "\u{1f195}",
            "category": "symbol"
        },
        {
            "name": "up",
            "value": "\u{1f199}",
            "category": "symbol"
        },
        {
            "name": "cool",
            "value": "\u{1f192}",
            "category": "symbol"
        },
        {
            "name": "free",
            "value": "\u{1f193}",
            "category": "symbol"
        },
        {
            "name": "ng",
            "value": "\u{1f196}",
            "category": "symbol"
        },
        {
            "name": "signal-strength",
            "value": "\u{1f4f6}",
            "category": "symbol"
        },
        {
            "name": "cinema",
            "value": "\u{1f3a6}",
            "category": "symbol"
        },
        {
            "name": "koko",
            "value": "\u{1f201}",
            "category": "symbol"
        },
        {
            "name": "u6307",
            "value": "\u{1f22f}",
            "category": "symbol"
        },
        {
            "name": "u7a7a",
            "value": "\u{1f233}",
            "category": "symbol"
        },
        {
            "name": "u6e80",
            "value": "\u{1f235}",
            "category": "symbol"
        },
        {
            "name": "u5408",
            "value": "\u{1f234}",
            "category": "symbol"
        },
        {
            "name": "u7981",
            "value": "\u{1f232}",
            "category": "symbol"
        },
        {
            "name": "ideograph-advantage",
            "value": "\u{1f250}",
            "category": "symbol"
        },
        {
            "name": "u5272",
            "value": "\u{1f239}",
            "category": "symbol"
        },
        {
            "name": "u55b6",
            "value": "\u{1f23a}",
            "category": "symbol"
        },
        {
            "name": "u6709",
            "value": "\u{1f236}",
            "category": "symbol"
        },
        {
            "name": "u7121",
            "value": "\u{1f21a}",
            "category": "symbol"
        },
        {
            "name": "restroom",
            "value": "\u{1f6bb}",
            "category": "symbol"
        },
        {
            "name": "mens",
            "value": "\u{1f6b9}",
            "category": "symbol"
        },
        {
            "name": "womens",
            "value": "\u{1f6ba}",
            "category": "symbol"
        },
        {
            "name": "baby-symbol",
            "value": "\u{1f6bc}",
            "category": "symbol"
        },
        {
            "name": "wc",
            "value": "\u{1f6be}",
            "category": "symbol"
        },
        {
            "name": "potable-water",
            "value": "\u{1f6b0}",
            "category": "symbol"
        },
        {
            "name": "put-litter-in-its-place",
            "value": "\u{1f6ae}",
            "category": "symbol"
        },
        {
            "name": "parking",
            "value": "\u{1f17f}",
            "category": "symbol"
        },
        {
            "name": "wheelchair",
            "value": "\u{267f}",
            "category": "symbol"
        },
        {
            "name": "no-smoking",
            "value": "\u{1f6ad}",
            "category": "symbol"
        },
        {
            "name": "u6708",
            "value": "\u{1f237}",
            "category": "symbol"
        },
        {
            "name": "u7533",
            "value": "\u{1f238}",
            "category": "symbol"
        },
        {
            "name": "sa",
            "value": "\u{1f202}",
            "category": "symbol"
        },
        {
            "name": "m",
            "value": "\u{24c2}",
            "category": "symbol"
        },
        {
            "name": "passport-control",
            "value": "\u{1f6c2}",
            "category": "symbol"
        },
        {
            "name": "baggage-claim",
            "value": "\u{1f6c4}",
            "category": "symbol"
        },
        {
            "name": "left-luggage",
            "value": "\u{1f6c5}",
            "category": "symbol"
        },
        {
            "name": "customs",
            "value": "\u{1f6c3}",
            "category": "symbol"
        },
        {
            "name": "accept",
            "value": "\u{1f251}",
            "category": "symbol"
        },
        {
            "name": "secret",
            "value": "\u{3299}",
            "category": "symbol"
        },
        {
            "name": "congratulations",
            "value": "\u{3297}",
            "category": "symbol"
        },
        {
            "name": "cl",
            "value": "\u{1f191}",
            "category": "symbol"
        },
        {
            "name": "sos",
            "value": "\u{1f198}",
            "category": "symbol"
        },
        {
            "name": "id",
            "value": "\u{1f194}",
            "category": "symbol"
        },
        {
            "name": "no-entry-sign",
            "value": "\u{1f6ab}",
            "category": "symbol"
        },
        {
            "name": "underage",
            "value": "\u{1f51e}",
            "category": "symbol"
        },
        {
            "name": "no-mobile-phones",
            "value": "\u{1f4f5}",
            "category": "symbol"
        },
        {
            "name": "do-not-litter",
            "value": "\u{1f6af}",
            "category": "symbol"
        },
        {
            "name": "non-potable-water",
            "value": "\u{1f6b1}",
            "category": "symbol"
        },
        {
            "name": "no-bicycles",
            "value": "\u{1f6b3}",
            "category": "symbol"
        },
        {
            "name": "no-pedestrians",
            "value": "\u{1f6b7}",
            "category": "symbol"
        },
        {
            "name": "children-crossing",
            "value": "\u{1f6b8}",
            "category": "symbol"
        },
        {
            "name": "no-entry",
            "value": "\u{26d4}",
            "category": "symbol"
        },
        {
            "name": "eight-spoked-asterisk",
            "value": "\u{2733}",
            "category": "symbol"
        },
        {
            "name": "table-lamp",
            "value": "\u{2747}",
            "category": "symbol"
        },
        {
            "name": "negative-squared-cross-mark",
            "value": "\u{274e}",
            "category": "symbol"
        },
        {
            "name": "white-check-mark",
            "value": "\u{2705}",
            "category": "symbol"
        },
        {
            "name": "eight-pointed-black-star",
            "value": "\u{2734}",
            "category": "symbol"
        },
        {
            "name": "heart-decoration",
            "value": "\u{1f49f}",
            "category": "symbol"
        },
        {
            "name": "vs",
            "value": "\u{1f19a}",
            "category": "symbol"
        },
        {
            "name": "vibration-mode",
            "value": "\u{1f4f3}",
            "category": "symbol"
        },
        {
            "name": "mobile-phone-off",
            "value": "\u{1f4f4}",
            "category": "symbol"
        },
        {
            "name": "a",
            "value": "\u{1f170}",
            "category": "symbol"
        },
        {
            "name": "b",
            "value": "\u{1f171}",
            "category": "symbol"
        },
        {
            "name": "ab",
            "value": "\u{1f18e}",
            "category": "symbol"
        },
        {
            "name": "o2",
            "value": "\u{1f17e}",
            "category": "symbol"
        },
        {
            "name": "diamond-shape-with-a-dot-inside",
            "value": "\u{1f4a0}",
            "category": "symbol"
        },
        {
            "name": "loop",
            "value": "\u{27bf}",
            "category": "symbol"
        },
        {
            "name": "recycle",
            "value": "\u{267b}",
            "category": "symbol"
        },
        {
            "name": "aries",
            "value": "\u{2648}",
            "category": "symbol"
        },
        {
            "name": "taurus",
            "value": "\u{2649}",
            "category": "symbol"
        },
        {
            "name": "gemini",
            "value": "\u{264a}",
            "category": "symbol"
        },
        {
            "name": "cancer",
            "value": "\u{264b}",
            "category": "symbol"
        },
        {
            "name": "leo",
            "value": "\u{264c}",
            "category": "symbol"
        },
        {
            "name": "virgo",
            "value": "\u{264d}",
            "category": "symbol"
        },
        {
            "name": "libra",
            "value": "\u{264e}",
            "category": "symbol"
        },
        {
            "name": "scorpius",
            "value": "\u{264f}",
            "category": "symbol"
        },
        {
            "name": "sagittarius",
            "value": "\u{2650}",
            "category": "symbol"
        },
        {
            "name": "capricorn",
            "value": "\u{2651}",
            "category": "symbol"
        },
        {
            "name": "aquarius",
            "value": "\u{2652}",
            "category": "symbol"
        },
        {
            "name": "pisces",
            "value": "\u{2653}",
            "category": "symbol"
        },
        {
            "name": "ophiuchus",
            "value": "\u{26ce}",
            "category": "symbol"
        },
        {
            "name": "six-pointed-star",
            "value": "\u{1f52f}",
            "category": "symbol"
        },
        {
            "name": "atm",
            "value": "\u{1f3e7}",
            "category": "symbol"
        },
        {
            "name": "chart",
            "value": "\u{1f4b9}",
            "category": "symbol"
        },
        {
            "name": "heavy-dollar-sign",
            "value": "\u{1f4b2}",
            "category": "symbol"
        },
        {
            "name": "currency-exchange",
            "value": "\u{1f4b1}",
            "category": "symbol"
        },
        {
            "name": "copyright",
            "value": "\u{a9}",
            "category": "symbol"
        },
        {
            "name": "registered",
            "value": "\u{ae}",
            "category": "symbol"
        },
        {
            "name": "tm",
            "value": "\u{2122}",
            "category": "symbol"
        },
        {
            "name": "x",
            "value": "\u{274c}",
            "category": "symbol"
        },
        {
            "name": "bangbang",
            "value": "\u{203c}",
            "category": "symbol"
        },
        {
            "name": "interrobang",
            "value": "\u{2049}",
            "category": "symbol"
        },
        {
            "name": "exclamation",
            "value": "\u{2757}",
            "category": "symbol"
        },
        {
            "name": "question",
            "value": "\u{2753}",
            "category": "symbol"
        },
        {
            "name": "grey-exclamation",
            "value": "\u{2755}",
            "category": "symbol"
        },
        {
            "name": "grey-question",
            "value": "\u{2754}",
            "category": "symbol"
        },
        {
            "name": "o",
            "value": "\u{2b55}",
            "category": "symbol"
        },
        {
            "name": "top",
            "value": "\u{1f51d}",
            "category": "symbol"
        },
        {
            "name": "end",
            "value": "\u{1f51a}",
            "category": "symbol"
        },
        {
            "name": "back",
            "value": "\u{1f519}",
            "category": "symbol"
        },
        {
            "name": "on",
            "value": "\u{1f51b}",
            "category": "symbol"
        },
        {
            "name": "soon",
            "value": "\u{1f51c}",
            "category": "symbol"
        },
        {
            "name": "arrows-clockwise",
            "value": "\u{1f503}",
            "category": "symbol"
        },
        {
            "name": "clock12",
            "value": "\u{1f55b}",
            "category": "symbol"
        },
        {
            "name": "clock1230",
            "value": "\u{1f567}",
            "category": "symbol"
        },
        {
            "name": "clock1",
            "value": "\u{1f550}",
            "category": "symbol"
        },
        {
            "name": "clock130",
            "value": "\u{1f55c}",
            "category": "symbol"
        },
        {
            "name": "clock2",
            "value": "\u{1f551}",
            "category": "symbol"
        },
        {
            "name": "clock230",
            "value": "\u{1f55d}",
            "category": "symbol"
        },
        {
            "name": "clock3",
            "value": "\u{1f552}",
            "category": "symbol"
        },
        {
            "name": "clock330",
            "value": "\u{1f55e}",
            "category": "symbol"
        },
        {
            "name": "clock4",
            "value": "\u{1f553}",
            "category": "symbol"
        },
        {
            "name": "clock430",
            "value": "\u{1f55f}",
            "category": "symbol"
        },
        {
            "name": "clock5",
            "value": "\u{1f554}",
            "category": "symbol"
        },
        {
            "name": "clock530",
            "value": "\u{1f560}",
            "category": "symbol"
        },
        {
            "name": "clock6",
            "value": "\u{1f555}",
            "category": "symbol"
        },
        {
            "name": "clock7",
            "value": "\u{1f556}",
            "category": "symbol"
        },
        {
            "name": "clock8",
            "value": "\u{1f557}",
            "category": "symbol"
        },
        {
            "name": "clock9",
            "value": "\u{1f558}",
            "category": "symbol"
        },
        {
            "name": "clock10",
            "value": "\u{1f559}",
            "category": "symbol"
        },
        {
            "name": "clock11",
            "value": "\u{1f55a}",
            "category": "symbol"
        },
        {
            "name": "clock630",
            "value": "\u{1f561}",
            "category": "symbol"
        },
        {
            "name": "clock730",
            "value": "\u{1f562}",
            "category": "symbol"
        },
        {
            "name": "clock830",
            "value": "\u{1f563}",
            "category": "symbol"
        },
        {
            "name": "clock930",
            "value": "\u{1f564}",
            "category": "symbol"
        },
        {
            "name": "clock1030",
            "value": "\u{1f565}",
            "category": "symbol"
        },
        {
            "name": "clock1130",
            "value": "\u{1f566}",
            "category": "symbol"
        },
        {
            "name": "heavy-multiplication-x",
            "value": "\u{2716}",
            "category": "symbol"
        },
        {
            "name": "heavy-plus-sign",
            "value": "\u{2795}",
            "category": "symbol"
        },
        {
            "name": "heavy-minus-sign",
            "value": "\u{2796}",
            "category": "symbol"
        },
        {
            "name": "heavy-division-sign",
            "value": "\u{2797}",
            "category": "symbol"
        },
        {
            "name": "spades",
            "value": "\u{2660}",
            "category": "symbol"
        },
        {
            "name": "hearts",
            "value": "\u{2665}",
            "category": "symbol"
        },
        {
            "name": "clubs",
            "value": "\u{2663}",
            "category": "symbol"
        },
        {
            "name": "diamonds",
            "value": "\u{2666}",
            "category": "symbol"
        },
        {
            "name": "white-flower",
            "value": "\u{1f4ae}",
            "category": "symbol"
        },
        {
            "name": "100",
            "value": "\u{1f4af}",
            "category": "symbol"
        },
        {
            "name": "heavy-check-mark",
            "value": "\u{2714}",
            "category": "symbol"
        },
        {
            "name": "ballot-box-with-check",
            "value": "\u{2611}",
            "category": "symbol"
        },
        {
            "name": "radio-button",
            "value": "\u{1f518}",
            "category": "symbol"
        },
        {
            "name": "link",
            "value": "\u{1f517}",
            "category": "symbol"
        },
        {
            "name": "curly-loop",
            "value": "\u{27b0}",
            "category": "symbol"
        },
        {
            "name": "wavy-dash",
            "value": "\u{3030}",
            "category": "symbol"
        },
        {
            "name": "part-alternation-mark",
            "value": "\u{303d}",
            "category": "symbol"
        },
        {
            "name": "trident",
            "value": "\u{1f531}",
            "category": "symbol"
        },
        {
            "name": "black-medium-square",
            "value": "\u{25fc}",
            "category": "symbol"
        },
        {
            "name": "white-medium-square",
            "value": "\u{25fb}",
            "category": "symbol"
        },
        {
            "name": "black-medium-small-square",
            "value": "\u{25fe}",
            "category": "symbol"
        },
        {
            "name": "white-medium-small-square",
            "value": "\u{25fd}",
            "category": "symbol"
        },
        {
            "name": "black-small-square",
            "value": "\u{25aa}",
            "category": "symbol"
        },
        {
            "name": "white-small-square",
            "value": "\u{25ab}",
            "category": "symbol"
        },
        {
            "name": "small-red-triangle",
            "value": "\u{1f53a}",
            "category": "symbol"
        },
        {
            "name": "black-square-button",
            "value": "\u{1f532}",
            "category": "symbol"
        },
        {
            "name": "white-square-button",
            "value": "\u{1f533}",
            "category": "symbol"
        },
        {
            "name": "black-circle",
            "value": "\u{26ab}",
            "category": "symbol"
        },
        {
            "name": "white-circle",
            "value": "\u{26aa}",
            "category": "symbol"
        },
        {
            "name": "red-circle",
            "value": "\u{1f534}",
            "category": "symbol"
        },
        {
            "name": "large-blue-circle",
            "value": "\u{1f535}",
            "category": "symbol"
        },
        {
            "name": "small-red-triangle-down",
            "value": "\u{1f53b}",
            "category": "symbol"
        },
        {
            "name": "small-h-with-hook",
            "value": "\u{2b1c}",
            "category": "symbol"
        },
        {
            "name": "black-large-suare",
            "value": "\u{2b1b}",
            "category": "symbol"
        },
        {
            "name": "large-orange-diamond",
            "value": "\u{1f536}",
            "category": "symbol"
        },
        {
            "name": "large-blue-diamond",
            "value": "\u{1f537}",
            "category": "symbol"
        },
        {
            "name": "small-orange-diamond",
            "value": "\u{1f538}",
            "category": "symbol"
        },
        {
            "name": "small-blue-diamond",
            "value": "\u{1f539}",
            "category": "symbol"
        }
    ];



    $.TwemojiPicker = function(element, options) {
        if(!window.twemoji){
            console.error("twemoji library not loaded");
        }
        this.$el = $(element);
        this._init(options);

    };

    $.TwemojiPicker.defaults = {
        init: null,
        size: 25,
        icon: 'grinning',
        iconSize: 25,
        height: 100,
        width: null,
        category: ['smile', 'cherry-blossom', 'video-game', 'oncoming-automobile', 'symbols'],
        categorySize: 20,
        pickerPosition: null,
        pickerHeight: 150,
        pickerWidth: null,
    };

    $.TwemojiPicker.prototype = {
        _init : function(options) {
            this.options = $.extend(true, {}, $.TwemojiPicker.defaults, options);
            this._initPicker();
            this._initCategory();
            this._initTwemoji();
            this._initText();
            this._initStyle();
            this._initEvents();
        },

        _initPicker : function() {
            this.$wrapper = this.$el.wrap('<div class="twemoji-wrap"></div>').parent();
            var textareaId=this.$wrapper.find('textarea').get(0).id;
            var textAreaTitle=this.$wrapper.find('textarea').get(0).getAttribute('title');
            if(textAreaTitle){
                this.$wrapper.append('<div id="'+textareaId+'_twemoji" title="'+textAreaTitle+'" class="twemoji-textarea" style="overflow: -moz-scrollbars-none;" contentEditable="true"></div>');
            }else{
                this.$wrapper.append('<div id="'+textareaId+'_twemoji" class="twemoji-textarea" style="overflow: -moz-scrollbars-none;" contentEditable="true"></div>');
            }

            this.$wrapper.append('<div class="twemoji-textarea-duplicate"></div>');
            this.$wrapper.append('<div class="twemoji-icon-picker" id="'+textareaId+'_icon_picker">' + this.imageFromName(this.options.icon) + '</div>');
            this.$wrapper.append('<div class="twemoji-picker"></div>');

            this.$el.hide();
            this.$textarea          = this.$wrapper.find('.twemoji-textarea');
            this.$textareaDuplicate = this.$wrapper.find('.twemoji-textarea-duplicate').hide();
            this.$iconPicker        = this.$wrapper.find('.twemoji-icon-picker img');
            this.$picker            = this.$wrapper.find('.twemoji-picker').hide();
            this.$userTypedtext=[];
            this.resetTwEmoji=function(){
                this.$userTypedtext=[];
            };

        },

        _initCategory : function() {
            var self = this;

            var category      = this.options.category;
            this.categoryName = ['people', 'nature', 'object', 'place', 'symbol'];

            this.$picker.append('<div class="twemoji-picker-category"></div>');
            this.$pickerCategory = this.$picker.find('.twemoji-picker-category');

            $.each(this.categoryName, function(i, c) {
                self.$pickerCategory.append('<span data-category="' + c + '">' + self.imageFromName(category[i]) + '</span>');
            });

            this.$pickerCategory.append('<div class="close">&times;</div>');
            this.$pickerCategory.find('span:first').addClass('active');
        },

        _convertCharRefs: function (argstr)
        {
            var s = argstr;

            s = s.replace(/;&#/g, "\\u{");
            s = s.replace(/&#/, "\\u{");
            s = s.replace(/\\ux/g,"\\u{");
            s = s.replace(/;/g, "}");
            s = s.replace(/\s+$/,"");
            //s= s.replace(/\\u/g,"\\u{");

            return s+"}";
        },
        _initTwemoji : function() {
            var self = this;

            $.each(this.categoryName, function(i, c) {
                self.$picker.append('<div class="twemoji-list ' + c + '"></div>');

                $.each(emoji, function(j, e) {

                    let converted=window.twemoji.parse(e.value);
                    if (e.category === c) self.$wrapper.find('.twemoji-picker .' + c).append('<span>'+converted+'</span>');
                });
            });


            this.$twemojiList = this.$picker.find('.twemoji-list');

            this.$twemojiList.not(':first').hide();


        },

        _initText : function() {
            if(this.options.init) {
                var text  = this.options.init;
                var regex = /:([\w\-]+):/g;
                var items;

                while (items = regex.exec(text)) {
                    text = text.replace(items[0], this.imageFromName(items[1], true));
                }

                this.$textarea.attr("data-text",text);
                this.copyTextArea(this.$textarea.html());
            }
        },

        _initStyle : function() {
            this.$wrapper.css({
                width:  this.options.width  ? this.options.width  : '100%',
                height: this.options.height ? this.options.height : '',
            });

            this.$wrapper.find('img').css({
                width:  this.options.size,
                height: this.options.size,
            });

            this.$iconPicker.css({
                width:  this.options.iconSize,
                height: this.options.iconSize,
            });

            this.$pickerCategory.find('img').css({
                width:  this.options.categorySize,
                height: this.options.categorySize,
            });

            this.$twemojiList.css({
                width:  this.options.pickerWidth ? this.options.pickerWidth : '100%',
                height: this.options.pickerHeight,
            });

            this.$picker.css({
                width: this.options.pickerWidth              ? this.options.pickerWidth                 : '100%',
                top:   this.options.pickerPosition === 'top' ? '-' + this.$picker.outerHeight()  + 'px' : '',
            });
        },

        _clear:function () {
            var self = this;
            this.$textarea.html("");
            self.copyTextArea(this.$textarea.html());
        },

        _escapeHtml:function(string) {
            var htmlEscapes = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#x27;',
                '/': '&#x2F;'
            };

            // Regex containing the keys listed immediately above.
            var htmlEscaper = /[&<>"'\/]/g;

            // Escape a string for HTML interpolation.
            return ('' + string).replace(htmlEscaper, function (match) {
                return htmlEscapes[match];
            });
        },

        _initEvents : function() {
            var self = this;

            this.$textarea.on('keyup', function(e) {

                /*if (!navigator.userAgent.match(/Android/i)) {

                    if (e.keyCode === 8) {
                        self.$userTypedtext.pop();
                    } else if (e.keyCode === 13 && e.shiftKey) {
                        return;
                    } else if (e.keyCode === 13) {
                        self.$userTypedtext.push("\r\n");
                    }else if( e.key.length>1){
                        return;
                    }
                    else {
                        setTimeout(function () {
                            self.$userTypedtext.push(e.key);
                        },10)

                    }
                }*/
                self.copyTextArea($(this).html());

            });

            this.$textarea.on('paste', function(e) {
                let text=e.originalEvent.clipboardData.getData("text/plain");
                self.$userTypedtext.push(text);
                self.copyTextArea(self._escapeHtml(text));
            });
            this.$iconPicker.on('click', function() {
                if (!self.openedPicker) self.openPicker();
                else                    self.closePicker();
            });

            this.$pickerCategory.find('span').on('click', function() {
                var category = $(this).data('category');
                self.openCategory($(this), category);
            });

            this.$pickerCategory.find('.close').on('click', function() {
                if (self.openedPicker) self.closePicker();
            });

            this.$twemojiList.find('img').on('click', function() {
                self.copyTwemoji($(this));
            });
        },

        openPicker : function() {
            this.$picker.show();
            this.openedPicker = true;
        },

        closePicker : function() {
            this.$picker.hide();
            this.openedPicker = false;
        },

        openCategory : function(element, category) {
            this.$pickerCategory.find('span').removeClass('active');
            element.addClass('active');

            this.$twemojiList.not('.twemoji-picker .' + category).hide();
            this.$twemojiList.filter('.twemoji-picker .' + category).show();
        },

        copyTwemoji : function(twemoji) {
            var alt = twemoji.attr('alt');
            var src = twemoji.attr('src');

            this.$textarea.focus();
            this.pasteAtCursor(alt,src);
            this.$userTypedtext.push(alt);
            this.copyTextArea(this.$textarea.html());
        },

        copyTextArea : function(value) {
            var container = this.$textareaDuplicate.html(value.replace(/<script[^>]*>/gi, "&lt;script&gt;").replace(/<\/script[^>]*>/gi, "&lt;/script&gt;").replace(/&nbsp;/gi, " ").replace(/&nbsp;/gi, " "));

            container.find('img').replaceWith(function() { return this.alt; });

            //container.html().replace(/(<([^>]+)>)/ig, "");
            let content=container.html().replace(/<div>/gi,'\n').replace(/<\/div>/gi,'').replace(/<br>/gi,'');

            this.$el.val(content);
            /*if (navigator.userAgent.match(/Android/i)) {


            }else{
                console.log(this.$userTypedtext);
                this.$el.val(this.$userTypedtext.join(""));
            }*/


        },

        imageFromName : function(value, init) {
            var res = $.grep(emoji, function(e) { return e.name == value; });
            let ret;
            if (init){
                ret=window.twemoji.parse(res[0].value,{className:'twemoji-picker customEmoji'});
            } else{
                ret=window.twemoji.parse(res[0].value,{className:'emoji emoji_header'});
            }

            return ret;
            //return '<img class="emoji emoji_header" draggable="false" src="' + res[0].base64 + '" alt="' + value + '" >';
        },

        pasteAtCursor : function(alt,src) {
            var sel, range,text;

            text='<img class="emoji" src="' + src + '" alt="' + alt + '" width="' + "30px" + '" height="' + "30px" + '">';

            if (window.getSelection) {
                sel = window.getSelection();

                if (sel.getRangeAt && sel.rangeCount) {
                    range = sel.getRangeAt(0);
                    range.deleteContents();

                    var el       = document.createElement('div');
                    el.innerHTML = text;

                    var frag = document.createDocumentFragment(), node, lastNode;

                    while((node = el.firstChild)) {
                        lastNode = frag.appendChild(node);
                    }

                    range.insertNode(frag);

                    if (lastNode) {
                        range = range.cloneRange();
                        range.setStartAfter(lastNode);
                        range.collapse(true);
                        sel.removeAllRanges();
                        sel.addRange(range);
                    }
                }
            } else if (document.selection && document.selection.type != 'Control') {
                document.selection.createRange().pasteHTML(text);
            }
        }
    };

    $.fn.twemojiPicker = function(options) {
        var instance = $.data(this, 'twemojiPicker');

        this.each(function() {
            instance ? instance._init() : instance = $.data(this, 'twemojiPicker', new $.TwemojiPicker(this, options));
        });

        return instance;
    };

})(jQuery, window);
