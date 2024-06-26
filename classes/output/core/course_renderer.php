<?php

namespace theme_hokage\output\core;

use core_course_category;
use core_course_list_element;
use moodle_url;
use html_writer;
use coursecat_helper;
use stdClass;
use lang_string;

class course_renderer extends \core_course_renderer
{
    /**
     * Controller ini digunakan untuk mengatur semua tampilan course.
     * Extend dari Core Course Renderer
     * ---
     * Q: Mas, bisa nggak semua templatenya dijadiin satu aja? Kok ini serumit itu sih?
     * A: Bisa sebenernya, tapi flow dari moodle nya itu sudah diatur. Misal nih ya
     *    untuk halaman 'home', nanti dia manggil fungsi frontpage(). Kalau mau ngubah itu
     *    lebih rumit lagi. Karena kita sebatas override template, sebaiknya nggak ngutak-
     *    atik core component dari moodle. Atau bisa sebenarnya, tapi buat fungsi sendiri.
     *    Karena model function seperti ini agak menyulitkan untuk pembacaan jadi, silakan
     *    saja kalau mau memperbaharui function nya
     * ---
     * Flow Pemanggilan:
     *   - Frontpage (memanggil Frontpage Part)
     *     - Frontpage Part (untuk penataan tampilan, ini diisi Frontpage Available Courses)
     *   - Frontpage Avaliable Courses
     *   - Coursecat Courses
     *   - Coursecat Coursebox
     *     - Get Course Summary Image
     */

    /**
     * 
     */
    public function string_seemore($yourtext, $link): string
    {
        $string = strip_tags($yourtext);
        if (strlen($string) > 250) {

            // truncate string
            $stringCut = substr($string, 0, 250);
            $endPoint = strrpos($stringCut, ' ');

            //if the string doesn't contain any space then it will cut without word basis.
            $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
            $string .= '... <a href="' . $link . '">Baca Selengkapnya</a>';
        }
        return $string;
    }
    /**
     * Digunakan untuk mengatur berapa banyak tampilan course dan seperti apa tampilannya.
     * Sebenarnya dari default itu kan ada berbagai macam tampilan summary course, jadi
     * di sini itu untuk mengatur apa ada course yang mau di-hide, atau dibuat jadi even-odd,
     * atau first-last. Tapi karena kita tidak memakai hal seperti itu, maka kita ganti sesuai
     * kode sendiri saja.
     * ---
     * Di sini kita menampilkan 10 courses terbaru saja. Selebihnya bisa ditampilkan lewat
     * halaman Course dengan menekan tombol 'Lihat Course Lainnya'
     * ---
     * Masih dalam bentuk hard code (html_writer) karena agak rumit menjadikan templatenya
     */
    protected function coursecat_courses_mod(coursecat_helper $chelper, $courses, $totalcount = null)
    {
        global $CFG;

        if ($totalcount === null) {
            $totalcount = count($courses);
        }
        if (!$totalcount) {
            return '';
        }

        $attributes = $chelper->get_and_erase_attributes('courses');
        $content = html_writer::start_tag('div', $attributes);

        $coursecount = 0;
        foreach (array_reverse($courses) as $course) {
            $coursecount++;
            $classes = "col-5";
            $content .= $this->coursecat_coursebox_mod($chelper, $course, $classes);
            if ($coursecount > $CFG->courseswithsummarieslimit - 1) break;
        }
        $content .= html_writer::end_tag('div');

        if ($coursecount >= $CFG->courseswithsummarieslimit) {
            $content .= html_writer::start_tag('div', ['class' => 'landing-dark-bg text-center pt-10']);
            $content .= html_writer::start_tag('a', ['class' => 'btn btn-primary btn-md', 'href' => $CFG->wwwroot . '/course']);
            $content .= get_string('coursemore', 'theme_hokage');
            $content .= html_writer::end_tag('a');
            $content .= html_writer::end_div();
        }

        return $content;
    }

    /**
     * Ini fungsi untuk mencetak course. Dalam hal ini kita pakai
     * untuk mencetak card summary course, dan mengatur class &
     * berbagai macam hal yang akan ditampilkan.
     */
    protected function coursecat_coursebox_mod(coursecat_helper $chelper, $course, $additionalclasses = '')
    {
        if (!isset($this->strings->summary)) {
            $this->strings->summary = get_string('summary');
        }
        if ($chelper->get_show_courses() <= self::COURSECAT_SHOW_COURSES_COUNT) {
            return '';
        }
        if ($course instanceof stdClass) {
            $course = new core_course_list_element($course);
        }

        $classes = 'card shadow-sm h-500px m-2';
        if ($chelper->get_show_courses() < self::COURSECAT_SHOW_COURSES_EXPANDED) {
            $classes .= ' collapsed';
        }

        $context = new stdClass();
        $context->additionalclasses = $additionalclasses;
        $context->classes = $classes;
        $context->courseId = $course->id;
        $context->coruseType = self::COURSECAT_TYPE_COURSE;
        $context->content = $this->coursecat_coursebox_mod_content($chelper, $course);
        return $this->render_from_template("course/summary/coursebox_parent", $context);
    }

    /**
     * Fungsinya? Pakek nanya segala. Ini tuh fungsinya buat menampilkan
     * content dari course summary. Mulai dari nama, sampai tombol link-nya
     */
    protected function coursecat_coursebox_mod_content(coursecat_helper $chelper, $course)
    {
        if ($course instanceof stdClass) {
            $course = new core_course_list_element($course);
        }

        $coursename = $chelper->get_course_formatted_name($course);
        $courseurl = new moodle_url('/course/view.php', ['id' => $course->id]);
        $coursenamelink = html_writer::link($courseurl, $coursename, ['class' => $course->visible ? 'aalink' : 'aalink dimmed']);

        /*
        // Masih belum tahu fungsinya apa???
        if ($course->has_course_contacts()) {
            $content .= html_writer::start_tag('div', ['class' => 'teachers pt-2']);
            $content .= html_writer::start_tag('ul', ['class' => 'list-unstyled m-0 font-weight-light']);
            foreach ($course->get_course_contacts() as $userid => $coursecontact) {
                $name = $coursecontact['rolename'] . ': ' . html_writer::link(
                    new moodle_url('/user/view.php', ['id' => $userid, 'course' => SITEID]),
                    $coursecontact['username']
                );
                $content .= html_writer::tag('li', $name);
            }
            $content .= html_writer::end_tag('ul');
            $content .= html_writer::end_tag('div');
        }
        */

        $context = new stdClass();
        $context->courseName = $coursename;
        $context->courseUrl = $courseurl;
        $context->courseNameLink = $coursenamelink;
        $context->courseImage = $this->get_course_summary_image_mod($course);
        if (!empty($course->summary)) {
            $context->content = $this->string_seemore($course->summary, $courseurl);
        } else {
            $context->content = get_string('summaryempty', 'theme_hokage');
        }
        // $context->content = $chelper->get_course_formatted_summary($course, ['clean' => true, 'para' => false]);
        return $this->render_from_template('course/summary/coursebox_child', $context);
    }

    /**
     * Mencetak gambar dari Course. Kalau ada gambar dia cetak, tapi
     * kalau nggak ada dia buat sendiri semacam random.
     */
    protected function get_course_summary_image_mod($course)
    {
        global $CFG;

        $context = new stdClass();
        $context->imageSrc = '';
        foreach ($course->get_course_overviewfiles() as $file) {
            $isimage = $file->is_valid_image();
            $url = new moodle_url(
                "$CFG->wwwroot/pluginfile.php/" . $file->get_contextid() . '/' . $file->get_component() . '/'
                    . $file->get_filearea() . $file->get_filepath() . $file->get_filename()
            );
            if ($isimage) {
                $context->imageSrc = $url;
                break;
            }
        }

        if (empty($context->imageSrc)) {
            $pattern = new \core_geopattern();
            $pattern->patternbyid($course->id);
            $context->imageSrc = $pattern->datauri();
        }

        return $this->render_from_template('course/summary/content_image', $context);
    }

    /**
     * Digunakan untuk mengatur Coursecat Courses & memberikan header
     * atau data awal yang akan digunakan oleh function tersebut dalam
     * mengatur tampilan.
     */
    public function frontpage_available_courses_mod()
    {
        global $CFG;

        $chelper = new coursecat_helper();
        $chelper->set_show_courses(self::COURSECAT_SHOW_COURSES_EXPANDED)->set_courses_display_options(array(
            'recursive' => true,
            'limit' => $CFG->frontpagecourselimit,
            'viewmoreurl' => new moodle_url('/course/index.php'),
            'viewmoretext' => new lang_string('fulllistofcourses')
        ));

        $chelper->set_attributes(array('class' => 'frontpage-course-list-all d-flex flex-row flex-nowrap overflow-auto'));
        $courses = core_course_category::top()->get_courses($chelper->get_courses_display_options());
        $totalcount = core_course_category::top()->get_courses_count($chelper->get_courses_display_options());

        return $this->coursecat_courses_mod($chelper, $courses, $totalcount);
    }

    /**
     * Atur div paling atas di dalam output.main_content.
     * Ini mengatur isi summary sesuai yang dipanggil oleh Frontpage()
     * ---
     * Note: $skipdivid tidak digunakan karena kita menghilangkan button skipnya
     */
    protected function frontpage_part_mod($skipdivid, $contentsdivid, $header, $contents)
    {
        if (strval($contents) === '') {
            return '';
        }
        $output = html_writer::link(
            '#' . $skipdivid,
            get_string('skipa', 'access', \core_text::strtolower(strip_tags($header))),
            array('class' => 'skip-block skip aabtn')
        );

        // Wrap frontpage part in div container.
        $output .= html_writer::start_tag('div', array('id' => $contentsdivid));
        $output .= html_writer::start_tag('h1', ['class' => 'fw-bold text-center text-white mt-10 mb-5']);
        $output .= $header;
        $output .= html_writer::end_tag('h1');

        $output .= $contents;

        // End frontpage part div container.
        $output .= html_writer::end_tag('div');

        $output .= html_writer::tag('span', '', array('class' => 'skip-block-to', 'id' => $skipdivid));
        return $output;
    }


    /**
     * Kode utama untuk nampilkan content di frontpage (output.main_content)
     * ---
     * Kok ada settingan switch nya itu darimana ngaturnya? Itu di settingan,
     * CFG alias config. Dalam hal ini kita cuma setting isi templatenya saja,
     * jadi biarkan apa adanya.
     */
    public function frontpage()
    {
        global $CFG, $SITE;

        $output = '';

        if (isloggedin() and !isguestuser() and isset($CFG->frontpageloggedin)) {
            $frontpagelayout = $CFG->frontpageloggedin;
        } else {
            $frontpagelayout = $CFG->frontpage;
        }

        foreach (explode(',', $frontpagelayout) as $v) {
            switch ($v) {
                    // Display the main part of the front page.
                case FRONTPAGENEWS:
                    if ($SITE->newsitems) {
                        // Print forums only when needed.
                        require_once($CFG->dirroot . '/mod/forum/lib.php');
                        if (($newsforum = forum_get_course_forum($SITE->id, 'news')) &&
                            ($forumcontents = $this->frontpage_news($newsforum))
                        ) {
                            $newsforumcm = get_fast_modinfo($SITE)->instances['forum'][$newsforum->id];
                            $output .= $this->frontpage_part(
                                'skipsitenews',
                                'site-news-forum',
                                $newsforumcm->get_formatted_name(),
                                $forumcontents
                            );
                        }
                    }
                    break;

                case FRONTPAGEENROLLEDCOURSELIST:
                    $mycourseshtml = $this->frontpage_my_courses();
                    if (!empty($mycourseshtml)) {
                        $output .= $this->frontpage_part(
                            'skipmycourses',
                            'frontpage-course-list',
                            get_string('mycourses'),
                            $mycourseshtml
                        );
                    }
                    break;

                case FRONTPAGEALLCOURSELIST:
                    $availablecourseshtml = $this->frontpage_available_courses_mod();
                    $output .= $this->frontpage_part_mod(
                        'skipavailablecourses',
                        'frontpage-available-course-list',
                        get_string('availablecourses', "theme_hokage"),
                        $availablecourseshtml
                    );
                    break;

                case FRONTPAGECATEGORYNAMES:
                    $output .= $this->frontpage_part(
                        'skipcategories',
                        'frontpage-category-names',
                        get_string('categories'),
                        $this->frontpage_categories_list()
                    );
                    break;

                case FRONTPAGECATEGORYCOMBO:
                    $output .= $this->frontpage_part(
                        'skipcourses',
                        'frontpage-category-combo',
                        get_string('courses'),
                        $this->frontpage_combo_list()
                    );
                    break;

                case FRONTPAGECOURSESEARCH:
                    $output .= $this->box($this->course_search_form(''), 'd-flex justify-content-center');
                    break;
            }
            $output .= '<br />';
        }

        return $output;
    }
}
