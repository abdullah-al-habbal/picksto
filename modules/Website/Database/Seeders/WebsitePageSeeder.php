<?php

declare(strict_types=1);

namespace Modules\Website\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Website\Models\WebsitePageModel;

final class WebsitePageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'slug' => 'about',
                'title' => [
                    'en' => 'About Us',
                    'ar' => 'من نحن',
                ],
                'content' => [
                    'en' => 'Welcome to Picksto — your go-to platform for accessing premium design assets effortlessly. We connect creative professionals with high-quality images, vectors, templates, and more from leading marketplaces like Freepik, Envato Elements, and Shutterstock.

Our mission is to simplify the creative workflow by providing a single subscription that unlocks thousands of premium resources. Whether you\'re a graphic designer, content creator, or marketing professional, Picksto gives you the tools you need to bring your vision to life.

We believe in quality, speed, and reliability. Our automated browser service ensures fast downloads around the clock, so you can focus on what matters most — creating.',
                    'ar' => 'مرحباً بكم في بكستو — منصتكم الرقمية للوصول إلى أصول التصميم المتميزة بسهولة. نحن نربط المحترفين المبدعين بصور عالية الجودة ومتجهات وقوالب والمزيد من الأسواق الرائدة مثل Freepik و Envato Elements و Shutterstock.

مهمتنا هي تبسيط سير العمل الإبداعي من خلال توفير اشتراك واحد يفتح آلاف الموارد المتميزة. سواء كنت مصمماً جرافيكياً أو منشئ محتوى أو محترف تسويق، بكستو تمنحك الأدوات التي تحتاجها لتحقيق رؤيتك.

نحن نؤمن بالجودة والسرعة والموثوقية. خدمة المتصفح الآلي لدينا تضمن تنزيلات سريعة على مدار الساعة، حتى تتمكن من التركيز على ما يهم حقاً — الإبداع.',
                ],
                'meta_description' => 'Learn more about Picksto — your platform for premium design asset downloads.',
                'is_active' => true,
            ],
            [
                'slug' => 'services',
                'title' => [
                    'en' => 'Our Services',
                    'ar' => 'خدماتنا',
                ],
                'content' => [
                    'en' => 'Picksto offers a range of services designed to make premium design assets accessible to everyone.

Automated Downloads
Our browser service automatically processes download requests from supported marketplaces. Simply submit the URL, and we handle the rest.

Multi-Platform Support
We support downloads from Freepik, Flaticon, Envato Elements, Shutterstock, MotionArray, and more. One subscription covers multiple platforms.

Fast & Reliable
Our infrastructure is built for speed. Download requests are processed within seconds, so you can get back to work without waiting.

24/7 Availability
Access our services anytime, anywhere. Our automated system works around the clock to serve your download needs.

Subscription Plans
Choose from flexible plans tailored to different needs — from casual designers to enterprise teams.',
                    'ar' => 'تقدم بكستو مجموعة من الخدمات المصممة لجعل أصول التصميم المتميزة في متناول الجميع.

تنزيلات آلية
تقوم خدمة المتصفح الآلي لدينا بمعالجة طلبات التنزيل من الأسواق المدعومة تلقائياً. ما عليك سوى إرسال الرابط، ونحن نتولى الباقي.

دعم متعدد المنصات
نحن ندعم التنزيلات من Freepik و Flaticon و Envato Elements و Shutterstock و MotionArray والمزيد. اشتراك واحد يغطي منصات متعددة.

سرعة وموثوقية
بنيتنا التحتية مصممة للسرعة. تتم معالجة طلبات التنزيل في ثوانٍ، حتى تتمكن من العودة إلى العمل دون انتظار.

متاح 24/7
يمكنك الوصول إلى خدماتنا في أي وقت ومن أي مكان. نظامنا الآلي يعمل على مدار الساعة لتلبية احتياجات التنزيل الخاصة بك.

باقات اشتراك
اختر من بين خطط مرنة مصممة لتناسب الاحتياجات المختلفة — من المصممين العاديين إلى فرق المؤسسات.',
                ],
                'meta_description' => 'Discover Picksto\'s automated download services for premium design assets.',
                'is_active' => true,
            ],
        ];

        foreach ($pages as $page) {
            WebsitePageModel::updateOrCreate(
                ['slug' => $page['slug']],
                $page,
            );
        }
    }
}
