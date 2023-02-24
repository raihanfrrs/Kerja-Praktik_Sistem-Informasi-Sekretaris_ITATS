<?php

namespace Database\Seeders;

use App\Models\Surat;
use Illuminate\Database\Seeder;

class SuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $surats = [
            [
                'jenis_surat_id' => '3',
                'name' => 'Surat Rekomendasi',
                'description' => '<b>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed augue diam, finibus eget tellus sit amet, pulvinar varius lacus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Suspendisse vitae scelerisque neque, sit amet volutpat odio. Donec vel dui at velit iaculis lobortis. Fusce sed quam ullamcorper, aliquet quam id, aliquam tellus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam accumsan risus at mi luctus sodales. Aliquam sit amet nisl a tellus tempus condimentum.

                In ac nunc ac mauris tempor tempor vitae non arcu. Nam vel tincidunt mi, sit amet volutpat turpis. Vivamus quis blandit quam, eget ultrices elit. In hac habitasse platea dictumst. Vestibulum aliquet rhoncus nibh eu porttitor. Proin ultricies sed dolor vel dapibus. Quisque et aliquam nunc. Proin ac sollicitudin felis, ac facilisis diam. In pharetra facilisis tortor semper tempor. Morbi condimentum elit nulla, non pharetra enim semper at. Etiam viverra dolor quis eleifend ullamcorper. Donec eget odio porttitor dui efficitur malesuada sit amet sed elit. Aliquam blandit quis nibh at porta. Etiam placerat vestibulum consequat. Praesent iaculis vel turpis nec convallis. Nunc sed urna id ipsum laoreet bibendum ac vulputate nunc.
                
                Ut convallis mattis maximus. Mauris vel efficitur erat. Nunc scelerisque dictum velit, sed pretium lectus congue ac. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Mauris vel elit sed purus venenatis aliquet ut nec velit. Sed ac feugiat lorem. Duis nec tortor et massa facilisis venenatis et quis lectus. Quisque posuere mattis elit, pharetra tincidunt ex ultrices in. Phasellus et pharetra tortor. Aenean quis semper massa. Nunc nec nisi ac sem blandit elementum.
                
                Quisque rutrum, arcu non gravida tincidunt, tortor justo tristique enim, non cursus nisi justo eu dui. Nullam eget viverra tellus, eu iaculis arcu. Ut nec euismod magna. Aliquam aliquet mi sit amet magna eleifend viverra. Cras laoreet ex eget facilisis tincidunt. Phasellus ut mauris rhoncus, convallis augue et, euismod est. Maecenas id lectus turpis. Nam a sodales magna, non condimentum turpis. Aenean ac egestas lacus, in mollis elit. Praesent id aliquam enim. Quisque nec suscipit eros. Vivamus faucibus velit diam, sit amet consequat eros cursus non.
                
                Sed sed vulputate quam. Aenean blandit dapibus ligula, nec volutpat elit efficitur eget. Sed in elit a tortor blandit tincidunt. Suspendisse placerat varius felis, et venenatis odio hendrerit a. Suspendisse felis lacus, blandit sed orci non, scelerisque elementum ex. Duis sagittis maximus lectus maximus fermentum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vitae tincidunt elit. Curabitur mattis efficitur dolor id tristique. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Etiam dictum ultricies ex a ullamcorper. Etiam scelerisque arcu nisl, eget dapibus nunc consectetur eu. Integer leo risus, dignissim id scelerisque id, dapibus in enim.</b>'
            ],
            [
                'jenis_surat_id' => '3',
                'name' => 'SPTJM',
                'description' => '<i>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed augue diam, finibus eget tellus sit amet, pulvinar varius lacus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Suspendisse vitae scelerisque neque, sit amet volutpat odio. Donec vel dui at velit iaculis lobortis. Fusce sed quam ullamcorper, aliquet quam id, aliquam tellus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam accumsan risus at mi luctus sodales. Aliquam sit amet nisl a tellus tempus condimentum.

                In ac nunc ac mauris tempor tempor vitae non arcu. Nam vel tincidunt mi, sit amet volutpat turpis. Vivamus quis blandit quam, eget ultrices elit. In hac habitasse platea dictumst. Vestibulum aliquet rhoncus nibh eu porttitor. Proin ultricies sed dolor vel dapibus. Quisque et aliquam nunc. Proin ac sollicitudin felis, ac facilisis diam. In pharetra facilisis tortor semper tempor. Morbi condimentum elit nulla, non pharetra enim semper at. Etiam viverra dolor quis eleifend ullamcorper. Donec eget odio porttitor dui efficitur malesuada sit amet sed elit. Aliquam blandit quis nibh at porta. Etiam placerat vestibulum consequat. Praesent iaculis vel turpis nec convallis. Nunc sed urna id ipsum laoreet bibendum ac vulputate nunc.
                
                Ut convallis mattis maximus. Mauris vel efficitur erat. Nunc scelerisque dictum velit, sed pretium lectus congue ac. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Mauris vel elit sed purus venenatis aliquet ut nec velit. Sed ac feugiat lorem. Duis nec tortor et massa facilisis venenatis et quis lectus. Quisque posuere mattis elit, pharetra tincidunt ex ultrices in. Phasellus et pharetra tortor. Aenean quis semper massa. Nunc nec nisi ac sem blandit elementum.
                
                Quisque rutrum, arcu non gravida tincidunt, tortor justo tristique enim, non cursus nisi justo eu dui. Nullam eget viverra tellus, eu iaculis arcu. Ut nec euismod magna. Aliquam aliquet mi sit amet magna eleifend viverra. Cras laoreet ex eget facilisis tincidunt. Phasellus ut mauris rhoncus, convallis augue et, euismod est. Maecenas id lectus turpis. Nam a sodales magna, non condimentum turpis. Aenean ac egestas lacus, in mollis elit. Praesent id aliquam enim. Quisque nec suscipit eros. Vivamus faucibus velit diam, sit amet consequat eros cursus non.
                
                Sed sed vulputate quam. Aenean blandit dapibus ligula, nec volutpat elit efficitur eget. Sed in elit a tortor blandit tincidunt. Suspendisse placerat varius felis, et venenatis odio hendrerit a. Suspendisse felis lacus, blandit sed orci non, scelerisque elementum ex. Duis sagittis maximus lectus maximus fermentum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vitae tincidunt elit. Curabitur mattis efficitur dolor id tristique. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Etiam dictum ultricies ex a ullamcorper. Etiam scelerisque arcu nisl, eget dapibus nunc consectetur eu. Integer leo risus, dignissim id scelerisque id, dapibus in enim.</i>'
            ]
        ];

        foreach ($surats as $key => $value) {
            Surat::create($value);
        }
    }
}
