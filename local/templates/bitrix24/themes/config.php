<?
use \Bitrix\Main\Localization\Loc;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

return array(

	"baseThemes" => array(
		"default" => array(
			"css" => array("main.css", "menu.css", "messenger.css")
		),

		"light" => array(
			"css" => array("main.css", "menu.css", "messenger.css")
		),

		"dark" => array(
			"css" => array("main.css", "menu.css", "messenger.css")
		)
	),

	"subThemes" => array(

		"default" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_DEFAULT"),
			"previewColor" => "#eef2f4",
			"previewImage" => "preview.jpg"
		),

		"light:sunset" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_SUNSET"),
			"prefetchImages" => array("sunset.jpg"),
			"previewImage" => "sunset-preview.jpg",
			"width" => 1920,
			"height" => 1080,
			"resizable" => true
		),

		"light:greenfield" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_GREENFIELD"),
			"prefetchImages" => array("greenfield.jpg"),
			"previewImage" => "greenfield-preview.jpg",
			"width" => 1920,
			"height" => 1080,
			"resizable" => true
		),

		"light:tulips" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_TULIPS"),
			"prefetchImages" => array("tulips.jpg"),
			"previewImage" => "tulips-preview.jpg",
			"width" => 1920,
			"height" => 1080,
			"resizable" => true
		),

		"light:grass" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_GRASS"),
			"prefetchImages" => array("grass.jpg"),
			"previewImage" => "grass-preview.jpg",
			"width" => 1920,
			"height" => 1080,
			"resizable" => true
		),

		"light:cloud-sea" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_CLOUD_SEA"),
			"prefetchImages" => array("cloud-sea.jpg"),
			"previewImage" => "cloud-sea-preview.jpg",
			"width" => 1920,
			"height" => 1080,
			"resizable" => true
		),

		"light:pink-fencer" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_PINK_FENCER"),
			"prefetchImages" => array("pink-fencer.jpg"),
			"previewImage" => "pink-fencer-preview.jpg",
			"width" => 1920,
			"height" => 1080,
			"resizable" => true
		),

		"light:grass-ears" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_GRASS_EARS"),
			"prefetchImages" => array("grass-ears.jpg"),
			"previewImage" => "grass-ears-preview.jpg",
			"width" => 1920,
			"height" => 1080,
			"resizable" => true
		),

		"light:atmosphere" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_ATMOSPHERE"),
			"prefetchImages" => array("atmosphere.jpg"),
			"previewImage" => "atmosphere-preview.jpg",
			"width" => 1920,
			"height" => 1080,
			"resizable" => true
		),

		"light:paradise" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_PARADISE"),
			"prefetchImages" => array("paradise.jpg"),
			"previewImage" => "paradise-preview.jpg",
			"width" => 1920,
			"height" => 1080,
			"resizable" => true
		),

		"light:village" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_VILLAGE"),
			"prefetchImages" => array("village.jpg"),
			"previewImage" => "village-preview.jpg",
			"width" => 1920,
			"height" => 1080,
			"resizable" => true
		),

		"light:mountains" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_MOUNTAINS"),
			"prefetchImages" => array("mountains.jpg"),
			"previewImage" => "mountains-preview.jpg",
			"width" => 1920,
			"height" => 1080,
			"resizable" => true
		),

		"light:beach" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_BEACH"),
			"prefetchImages" => array("beach.jpg"),
			"previewImage" => "beach-preview.jpg",
			"width" => 1920,
			"height" => 1080,
			"resizable" => true
		),

		"light:sea-sunset" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_SEA_SUNSET"),
			"prefetchImages" => array("sea-sunset.jpg"),
			"previewImage" => "sea-sunset-preview.jpg",
			"width" => 1920,
			"height" => 1080,
			"resizable" => true
		),

		"light:snow-village" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_SNOW_VILLAGE"),
			"prefetchImages" => array("snow-village.jpg"),
			"previewImage" => "snow-village-preview.jpg",
			"width" => 1920,
			"height" => 1080,
			"resizable" => true
		),

		"light:meditation" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_MEDITATION"),
			"prefetchImages" => array("meditation.jpg"),
			"previewImage" => "meditation-preview.jpg",
			"width" => 1920,
			"height" => 1080,
			"resizable" => true
		),

		"dark:starfish" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_STARFISH"),
			"prefetchImages" => array("starfish.jpg"),
			"previewImage" => "starfish-preview.jpg",
			"width" => 1920,
			"height" => 1080,
			"resizable" => true
		),

		"dark:sea-stones" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_SEA_STONES"),
			"prefetchImages" => array("sea-stones.jpg"),
			"previewImage" => "sea-stones-preview.jpg",
			"width" => 1920,
			"height" => 1080,
			"resizable" => true
		),

		"dark:seashells" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_SEASHELLS"),
			"prefetchImages" => array("seashells.jpg"),
			"previewImage" => "seashells-preview.jpg",
			"width" => 1920,
			"height" => 1080,
			"resizable" => true
		),

		"light:architecture" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_ARCHITECTURE"),
			"prefetchImages" => array("architecture.jpg"),
			"previewImage" => "architecture-preview.jpg",
			"width" => 1920,
			"height" => 1080,
			"resizable" => true
		),

		"light:skyscraper" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_SKYSCRAPER"),
			"prefetchImages" => array("skyscraper.jpg"),
			"previewImage" => "skyscraper-preview.jpg",
			"width" => 1920,
			"height" => 1080,
			"resizable" => true
		),

		"light:wall" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_WALL"),
			"prefetchImages" => array("wall.jpg"),
			"previewImage" => "wall-preview.jpg",
			"width" => 1920,
			"height" => 1080,
			"resizable" => true
		),

		"light:flower" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_FLOWER"),
			"prefetchImages" => array("flower.jpg"),
			"previewImage" => "flower-preview.jpg",
			"width" => 1920,
			"height" => 1080,
			"resizable" => true
		),

		"light:metro" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_METRO"),
			"prefetchImages" => array("metro.jpg"),
			"previewImage" => "metro-preview.jpg",
			"width" => 1920,
			"height" => 1080,
			"resizable" => true
		),

		"light:shining" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_SHINING"),
			"prefetchImages" => array("shining.jpg"),
			"previewImage" => "shining-preview.jpg",
			"width" => 1920,
			"height" => 1080,
			"resizable" => true
		),

		"light:stars" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_STARS"),
			"prefetchImages" => array("stars.jpg"),
			"previewImage" => "stars-preview.jpg",
			"width" => 1920,
			"height" => 1080,
			"resizable" => true
		),

		"light:clouds" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_CLOUDS"),
			"prefetchImages" => array("clouds.jpg"),
			"previewImage" => "clouds-preview.jpg",
			"width" => 1920,
			"height" => 1080,
			"resizable" => true
		),

		"light:canyon" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_CANYON"),
			"prefetchImages" => array("canyon.jpg"),
			"previewImage" => "canyon-preview.jpg",
			"width" => 1920,
			"height" => 1080,
			"resizable" => true
		),

		"light:mountains-3" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_MOUNTAINS"),
			"prefetchImages" => array("mountains-3.jpg"),
			"previewImage" => "mountains-3-preview.jpg",
			"width" => 1920,
			"height" => 1080,
			"resizable" => true
		),

		"light:valley" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_VALLEY"),
			"prefetchImages" => array("valley.jpg"),
			"previewImage" => "valley-preview.jpg",
			"width" => 1920,
			"height" => 1080,
			"resizable" => true
		),

		"light:leafs" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_LEAFS"),
			"prefetchImages" => array("leafs.jpg"),
			"previewImage" => "leafs-preview.jpg",
			"width" => 1920,
			"height" => 1080,
			"resizable" => true
		),

		"light:wind" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_WIND"),
			"prefetchImages" => array("wind.jpg"),
			"previewImage" => "wind-preview.jpg",
			"width" => 1920,
			"height" => 1080,
			"resizable" => true
		),

		"light:grass-2" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_GRASS"),
			"prefetchImages" => array("grass-2.jpg"),
			"previewImage" => "grass-2-preview.jpg",
			"width" => 1920,
			"height" => 1080,
			"resizable" => true
		),

		"light:tree" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_TREE"),
			"prefetchImages" => array("tree.jpg"),
			"previewImage" => "tree-preview.jpg",
			"width" => 1920,
			"height" => 1080,
			"resizable" => true
		),

		"light:red-field" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_RED_FIELD"),
			"prefetchImages" => array("red-field.jpg"),
			"previewImage" => "red-field-preview.jpg",
			"width" => 1920,
			"height" => 1080,
			"resizable" => true
		),

		"light:trees" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_TREES"),
			"prefetchImages" => array("trees.jpg"),
			"previewImage" => "trees-preview.jpg",
			"width" => 1920,
			"height" => 1080,
			"resizable" => true
		),

		"light:ice" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_ICE"),
			"prefetchImages" => array("ice.jpg"),
			"previewImage" => "ice-preview.jpg",
			"width" => 1920,
			"height" => 1080,
			"resizable" => true
		),

		"light:plant" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_PLANT"),
			"prefetchImages" => array("plant.jpg"),
			"previewImage" => "plant-preview.jpg",
			"width" => 1920,
			"height" => 1080,
			"resizable" => true
		),

		"light:mountains-2" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_MOUNTAINS"),
			"prefetchImages" => array("mountains-2.jpg"),
			"previewImage" => "mountains-2-preview.jpg",
			"width" => 1920,
			"height" => 1080,
			"resizable" => true
		),

		"light:countryside" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_COUNTRYSIDE"),
			"prefetchImages" => array("countryside.jpg"),
			"previewImage" => "countryside-preview.jpg",
			"width" => 1920,
			"height" => 1080,
			"resizable" => true
		),

		"light:morning" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_MORNING"),
			"prefetchImages" => array("morning.jpg"),
			"previewImage" => "morning-preview.jpg",
			"width" => 1920,
			"height" => 1080,
			"resizable" => true
		),

		"default:pattern-grey" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_DEFAULT_WITH_PATTERN"),
			"prefetchImages" => array("pattern-grey-header.svg", "pattern-grey.svg"),
			"previewImage" => "pattern-grey-preview.jpg",
			"previewColor" => "#eef2f4"
		),

		"light:pattern-bluish-green" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_PATTERN_BLUISH_GREEN"),
			"previewImage" => "pattern-bluish-green.svg",
			"previewColor" => "#62b7c0",
		),

		"light:pattern-blue" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_PATTERN_BLUE"),
			"prefetchImages" => array("pattern-blue.svg"),
			"previewImage" => "pattern-blue.svg",
			"previewColor" => "#3ea4d0",
		),

		"light:pattern-grey" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_PATTERN_GREY"),
			"previewImage" => "pattern-grey.svg",
			"previewColor" => "#545d6b",
		),

		"dark:pattern-sky-blue" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_PATTERN_SKY_BLUE"),
			"previewImage" => "pattern-sky-blue.svg",
			"previewColor" => "#ceecf9",
		),

		"dark:pattern-light-grey" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_PATTERN_LIGHT_GREY"),
			"previewImage" => "pattern-light-grey.svg",
			"previewColor" => "#e2e8eb"
		),

		"dark:pattern-pink" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_PATTERN_PINK"),
			"previewImage" => "pattern-pink.svg",
			"previewColor" => "#ffcdcd",
		),

		"light:pattern-presents" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_PATTERN_PRESENTS"),
			"previewImage" => "pattern-presents.svg",
			"previewColor" => "#0c588d",
		),

		"light:pattern-things" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_PATTERN_THINGS"),
			"previewImage" => "pattern-things.svg",
			"previewColor" => "#aa6dab",
		),

		"light:pattern-checked" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_PATTERN_CHECKED"),
			"previewImage" => "pattern-checked.jpg",
		),

		"light:video-star-sky" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_VIDEO_STAR_SKY"),
			"previewImage" => "star-sky-preview.jpg",
			"prefetchImages" => array("star-sky-poster.jpg"),
			"video" => array(
				"poster" => "star-sky-poster.jpg",
				"sources" => array(
					"webm" => "//video.1c-bitrix.ru/bitrix24/themes/video-star-sky/star-sky3.webm",
					"mp4" => "//video.1c-bitrix.ru/bitrix24/themes/video-star-sky/star-sky3.mp4"
				)
			),
			"resizable" => true
		),

		"light:video-waves" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_VIDEO_WAVES"),
			"previewImage" => "waves-preview.jpg",
			"prefetchImages" => array("waves-poster.jpg"),
			"video" => array(
				"poster" => "waves-poster.jpg",
				"sources" => array(
					"webm" => "//video.1c-bitrix.ru/bitrix24/themes/video-waves/waves3.webm",
					"mp4" => "//video.1c-bitrix.ru/bitrix24/themes/video-waves/waves3.mp4"
				)
			),
			"resizable" => true
		),

		"light:video-jellyfishes" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_VIDEO_JELLYFISHES"),
			"previewImage" => "jellyfishes-preview.jpg",
			"prefetchImages" => array("jellyfishes-poster.jpg"),
			"video" => array(
				"poster" => "jellyfishes-poster.jpg",
				"sources" => array(
					"webm" => "//video.1c-bitrix.ru/bitrix24/themes/video-jellyfishes/jellyfishes3.webm",
					"mp4" => "//video.1c-bitrix.ru/bitrix24/themes/video-jellyfishes/jellyfishes3.mp4"
				)
			),
			"resizable" => true
		),

		"light:video-sunset" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_VIDEO_SUNSET"),
			"previewImage" => "sunset-preview.jpg",
			"prefetchImages" => array("sunset-poster.jpg"),
			"video" => array(
				"poster" => "sunset-poster.jpg",
				"sources" => array(
					"webm" => "//video.1c-bitrix.ru/bitrix24/themes/video-sunset/sunset3.webm",
					"mp4" => "//video.1c-bitrix.ru/bitrix24/themes/video-sunset/sunset3.mp4"
				)
			),
			"resizable" => true
		),

		"light:video-rain" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_VIDEO_RAIN"),
			"previewImage" => "rain-preview.jpg",
			"prefetchImages" => array("rain-poster.jpg"),
			"video" => array(
				"poster" => "rain-poster.jpg",
				"sources" => array(
					"webm" => "//video.1c-bitrix.ru/bitrix24/themes/video-rain/rain3.webm",
					"mp4" => "//video.1c-bitrix.ru/bitrix24/themes/video-rain/rain3.mp4"
				)
			),
			"resizable" => true
		),

		"light:video-rain-drops" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_VIDEO_RAIN_DROPS"),
			"previewImage" => "rain-drops-preview.jpg",
			"prefetchImages" => array("rain-drops-poster.jpg"),
			"video" => array(
				"poster" => "rain-drops-poster.jpg",
				"sources" => array(
					"webm" => "//video.1c-bitrix.ru/bitrix24/themes/video-rain-drops/rain-drops3.webm",
					"mp4" => "//video.1c-bitrix.ru/bitrix24/themes/video-rain-drops/rain-drops3.mp4"
				)
			),
			"resizable" => true
		),

		"light:video-grass" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_VIDEO_GRASS"),
			"previewImage" => "grass-preview.jpg",
			"prefetchImages" => array("grass-poster.jpg"),
			"video" => array(
				"poster" => "grass-poster.jpg",
				"sources" => array(
					"webm" => "//video.1c-bitrix.ru/bitrix24/themes/video-grass/grass3.webm",
					"mp4" => "//video.1c-bitrix.ru/bitrix24/themes/video-grass/grass3.mp4"
				)
			),
			"resizable" => true
		),

		"light:video-stones" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_VIDEO_STONES"),
			"previewImage" => "stones-preview.jpg",
			"prefetchImages" => array("stones-poster.jpg"),
			"video" => array(
				"poster" => "stones-poster.jpg",
				"sources" => array(
					"webm" => "//video.1c-bitrix.ru/bitrix24/themes/video-stones/stones3.webm",
					"mp4" => "//video.1c-bitrix.ru/bitrix24/themes/video-stones/stones3.mp4"
				)
			),
			"resizable" => true
		),

		"light:video-waterfall" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_VIDEO_WATERFALL"),
			"previewImage" => "waterfall-preview.jpg",
			"prefetchImages" => array("waterfall-poster.jpg"),
			"video" => array(
				"poster" => "waterfall-poster.jpg",
				"sources" => array(
					"webm" => "//video.1c-bitrix.ru/bitrix24/themes/video-waterfall/waterfall3.webm",
					"mp4" => "//video.1c-bitrix.ru/bitrix24/themes/video-waterfall/waterfall3.mp4"
				)
			),
			"resizable" => true
		),

		"light:video-shining" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_VIDEO_SHINING"),
			"previewImage" => "shining-preview.jpg",
			"prefetchImages" => array("shining-poster.jpg"),
			"video" => array(
				"poster" => "shining-poster.jpg",
				"sources" => array(
					"webm" => "//video.1c-bitrix.ru/bitrix24/themes/video-shining/shining3.webm",
					"mp4" => "//video.1c-bitrix.ru/bitrix24/themes/video-shining/shining3.mp4"
				)
			),
			"resizable" => true
		),

		"light:video-beach" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_VIDEO_BEACH"),
			"previewImage" => "beach-preview.jpg",
			"prefetchImages" => array("beach-poster.jpg"),
			"video" => array(
				"poster" => "beach-poster.jpg",
				"sources" => array(
					"webm" => "//video.1c-bitrix.ru/bitrix24/themes/video-beach/beach3.webm",
					"mp4" => "//video.1c-bitrix.ru/bitrix24/themes/video-beach/beach3.mp4"
				)
			),
			"resizable" => true
		),

		"light:video-river" => array(
			"title" => Loc::getMessage("BITRIX24_THEME_VIDEO_RIVER"),
			"previewImage" => "river-preview.jpg",
			"prefetchImages" => array("river-poster.jpg"),
			"video" => array(
				"poster" => "river-poster.jpg",
				"sources" => array(
					"webm" => "//video.1c-bitrix.ru/bitrix24/themes/video-river/river.webm",
					"mp4" => "//video.1c-bitrix.ru/bitrix24/themes/video-river/river.mp4"
				)
			),
			"resizable" => true
		),
	),
);
