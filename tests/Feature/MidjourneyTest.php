<?php

namespace Tests\Feature;

use eDiasoft\Midjourney\MidjourneyApiClient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MidjourneyTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_page_is_displayed(): void
    {
        // $id = "1259404272374775868/1259404272374775871";
        $id = "1259404272374775871";
        $token = "MTI1OTQwMDYwNDE5OTk0NDIzOA.GKnS_B.13zV0qzuaVYcKWg9GHfXivsgB_OSZz1JKikyI4";
        $midjourney = new MidjourneyApiClient($id, $token);

        $image = "https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcQgByBT5IiAT_a2x9pUVb4VMoOrlzHH7Jrzj-HB5jzHlR4lNLMS";
        $imagineBuilder = $midjourney->imagine("$image have a teeth like a tiger");
        $imagineBuilder->aspectRatio('16:9') //Changing the aspect ratio.
        // ->chaos(30) //The higher the chaos the more unusual and unexpected results.
                       ->fast()              //Enable fast mode for this single job.
            // ->imageWeight(1.75) //Sets image prompt weight relative to text weight. The default value is 1.
            //                       ->no('moon roses') //Exclude specific object in the image.
            //                       ->quality(0.5)
            // ->relax() //This will turn on relax mode for this single job, the interval of retrieving the image will be also delayed.
            // ->repeat(40) //Create multiple Jobs from a single prompt.
            //                       ->seed(1000) //The Midjourney bot uses a seed number to create a field of visual noise, like television static, as a starting point to generate the initial image grids.
            //                       ->stop(35) //Stopping a Job at an earlier percentage can create blurrier, less detailed results.
            // ->style('cute')
            //                       ->stylize(5) //Influences how strongly Midjourney's default aesthetic style is applied
            //                       ->tile()     //Generates images that can be used as repeating tiles to create seamless patterns.
            // ->turbo() //Override your current setting and run a single job using Turbo Mode.
            //                       ->weird(1000); //Explore unusual aesthetics with the experimental weird parameter
        ;

        $result = $imagineBuilder->send();

        dump($result);
        /*
         array:17 [
  "type" => 0
  "content" => "**<https://s.mj.run/ofcw-RMB-rs> have a teeth like a tiger [668a48573ae4c]** - <@1259400604199944238> (fast)"
  "mentions" => array:1 [
    0 => array:12 [
      "id" => "1259400604199944238"
      "username" => "cs.v2"
      "avatar" => null
      "discriminator" => "0"
      "public_flags" => 0
      "flags" => 0
      "banner" => null
      "accent_color" => null
      "global_name" => "v2"
      "avatar_decoration_data" => null
      "banner_color" => null
      "clan" => null
    ]
  ]
  "mention_roles" => []
  "attachments" => array:1 [
    0 => array:10 [
      "id" => "1259415933282287636"
      "filename" => "cs.v2_have_a_teeth_like_a_tiger_668a48573ae4c_622b7e5f-c928-45af-be1f-90d43d1c0370.png"
      "size" => 7326414
      "url" => "https://cdn.discordapp.com/attachments/1259404272374775871/1259415933282287636/cs.v2_have_a_teeth_like_a_tiger_668a48573ae4c_622b7e5f-c928-45af-be1f-90d43d1c0370.png?ex=668b99fd&is=668a487d&hm=bc2edde5993a2889a5c826cdb7793c93707aa424a97a245ba79e14c44d4afb7c&"
      "proxy_url" => "https://media.discordapp.net/attachments/1259404272374775871/1259415933282287636/cs.v2_have_a_teeth_like_a_tiger_668a48573ae4c_622b7e5f-c928-45af-be1f-90d43d1c0370.png?ex=668b99fd&is=668a487d&hm=bc2edde5993a2889a5c826cdb7793c93707aa424a97a245ba79e14c44d4afb7c&"
      "width" => 2048
      "height" => 2048
      "content_type" => "image/png"
      "placeholder" => "2xgKBwCo94l8mXhnh2dYx5d+NqxA1QIE"
      "placeholder_version" => 1
    ]
  ]
  "embeds" => []
  "timestamp" => "2024-07-07T07:49:17.440000+00:00"
  "edited_timestamp" => null
  "flags" => 0
  "components" => array:2 [
    0 => array:3 [
      "type" => 1
      "id" => 1
      "components" => array:5 [
        0 => array:5 [
          "type" => 2
          "id" => 2
          "custom_id" => "MJ::JOB::upsample::1::622b7e5f-c928-45af-be1f-90d43d1c0370"
          "style" => 2
          "label" => "U1"
        ]
        1 => array:5 [
          "type" => 2
          "id" => 3
          "custom_id" => "MJ::JOB::upsample::2::622b7e5f-c928-45af-be1f-90d43d1c0370"
          "style" => 2
          "label" => "U2"
        ]
        2 => array:5 [
          "type" => 2
          "id" => 4
          "custom_id" => "MJ::JOB::upsample::3::622b7e5f-c928-45af-be1f-90d43d1c0370"
          "style" => 2
          "label" => "U3"
        ]
        3 => array:5 [
          "type" => 2
          "id" => 5
          "custom_id" => "MJ::JOB::upsample::4::622b7e5f-c928-45af-be1f-90d43d1c0370"
          "style" => 2
          "label" => "U4"
        ]
        4 => array:5 [
          "type" => 2
          "id" => 6
          "custom_id" => "MJ::JOB::reroll::0::622b7e5f-c928-45af-be1f-90d43d1c0370::SOLO"
          "style" => 2
          "emoji" => array:1 [
            "name" => "🔄"
          ]
        ]
      ]
    ]
    1 => array:3 [
      "type" => 1
      "id" => 7
      "components" => array:4 [
        0 => array:5 [
          "type" => 2
          "id" => 8
          "custom_id" => "MJ::JOB::variation::1::622b7e5f-c928-45af-be1f-90d43d1c0370"
          "style" => 2
          "label" => "V1"
        ]
        1 => array:5 [
          "type" => 2
          "id" => 9
          "custom_id" => "MJ::JOB::variation::2::622b7e5f-c928-45af-be1f-90d43d1c0370"
          "style" => 2
          "label" => "V2"
        ]
        2 => array:5 [
          "type" => 2
          "id" => 10
          "custom_id" => "MJ::JOB::variation::3::622b7e5f-c928-45af-be1f-90d43d1c0370"
          "style" => 2
          "label" => "V3"
        ]
        3 => array:5 [
          "type" => 2
          "id" => 11
          "custom_id" => "MJ::JOB::variation::4::622b7e5f-c928-45af-be1f-90d43d1c0370"
          "style" => 2
          "label" => "V4"
        ]
      ]
    ]
  ]
  "resolved" => array:4 [
    "users" => []
    "members" => []
    "channels" => []
    "roles" => []
  ]
  "id" => "1259415933823225928"
  "channel_id" => "1259404272374775871"
  "author" => array:13 [
    "id" => "936929561302675456"
    "username" => "Midjourney Bot"
    "avatar" => "f6ce562a6b4979c4b1cbc5b436d3be76"
    "discriminator" => "9282"
    "public_flags" => 589824
    "flags" => 589824
    "bot" => true
    "banner" => null
    "accent_color" => null
    "global_name" => null
    "avatar_decoration_data" => null
    "banner_color" => null
    "clan" => null
  ]
  "pinned" => false
  "mention_everyone" => false
  "tts" => false
]
         * */
    }

}
