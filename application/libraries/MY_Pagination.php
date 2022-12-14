<?php

defined('BASEPATH') || exit('No direct script access allowed');

class MY_Pagination extends CI_Pagination
{
    /**
     * Base URL
     *
     * The page that we're linking to
     *
     * @var string
     */
    public $base_url = '';

    /**
     * Prefix
     *
     * @var string
     */
    public $prefix = '';

    /**
     * Suffix
     *
     * @var string
     */
    public $suffix = '';

    /**
     * Total number of items
     *
     * @var int
     */
    public $total_rows = 0;

    /**
     * Number of links to show
     *
     * Relates to "digit" type links shown before/after
     * the currently viewed page.
     *
     * @var int
     */
    public $num_links = 2;

    /**
     * Items per page
     *
     * @var int
     */
    public $per_page = 10;

    /**
     * Current page
     *
     * @var int
     */
    public $cur_page = 0;

    /**
     * Use page numbers flag
     *
     * Whether to use actual page numbers instead of an offset
     *
     * @var bool
     */
    public $use_page_numbers = false;

    /**
     * First link
     *
     * @var string
     */
    public $first_link = '&lsaquo; First';

    /**
     * Next link
     *
     * @var string
     */
    public $next_link = '&gt;';

    /**
     * Previous link
     *
     * @var string
     */
    public $prev_link = '&lt;';

    /**
     * Display Previous link
     *
     * @var bool
     */
    public $display_prev_link = false;

    /**
     * Display Next link
     *
     * @var bool
     */
    public $display_next_link = false;

    /**
     * Last link
     *
     * @var string
     */
    public $last_link = 'Last &rsaquo;';

    /**
     * URI Segment
     *
     * @var int
     */
    public $uri_segment = 0;

    /**
     * Full tag open
     *
     * @var string
     */
    public $full_tag_open = '';

    /**
     * Full tag close
     *
     * @var string
     */
    public $full_tag_close = '';

    /**
     * First tag open
     *
     * @var string
     */
    public $first_tag_open = '';

    /**
     * First tag close
     *
     * @var string
     */
    public $first_tag_close = '';

    /**
     * Last tag open
     *
     * @var string
     */
    public $last_tag_open = '';

    /**
     * Last tag close
     *
     * @var string
     */
    public $last_tag_close = '';

    /**
     * First URL
     *
     * An alternative URL for the first page
     *
     * @var string
     */
    public $first_url = '';

    /**
     * Current tag open
     *
     * @var string
     */
    public $cur_tag_open = '<strong>';

    /**
     * Current tag close
     *
     * @var string
     */
    public $cur_tag_close = '</strong>';

    /**
     * Next tag open
     *
     * @var string
     */
    public $next_tag_open = '';

    /**
     * Next tag close
     *
     * @var string
     */
    public $next_tag_close = '';

    /**
     * Dead next tag open
     *
     * @var string
     */
    public $dead_tag_next_open = '<span>';

    /**
     * Dead next tag close
     *
     * @var string
     */
    public $dead_tag_next_close = '</span>';

    /**
     * Previous tag open
     *
     * @var string
     */
    public $prev_tag_open = '';

    /**
     * Previous tag close
     *
     * @var string
     */
    public $prev_tag_close = '';

    /**
     * Dead previous tag open
     *
     * @var string
     */
    public $dead_tag_prev_open = '<span>';

    /**
     * Dead previous tag close
     *
     * @var string
     */
    public $dead_tag_prev_close = '</span>';

    /**
     * Number tag open
     *
     * @var string
     */
    public $num_tag_open = '';

    /**
     * Number tag close
     *
     * @var string
     */
    public $num_tag_close = '';

    /**
     * Page query string flag
     *
     * @var bool
     */
    public $page_query_string = false;

    /**
     * Query string segment
     *
     * @var string
     */
    public $query_string_segment = 'per_page';

    /**
     * Display pages flag
     *
     * @var bool
     */
    public $display_pages = true;

    /**
     * Attributes
     *
     * @var string
     */
    public $_attributes = '';

    /**
     * Link types
     *
     * "rel" attribute
     *
     * @see	CI_Pagination::_attr_rel()
     *
     * @var array
     */
    public $_link_types = [];

    /**
     * Reuse query string flag
     *
     * @var bool
     */
    public $reuse_query_string = false;

    /**
     * Use global URL suffix flag
     *
     * @var bool
     */
    public $use_global_url_suffix = false;

    /**
     * Data page attribute
     *
     * @var string
     */
    public $data_page_attr = 'data-ci-pagination-page';

    /**
     * CI Singleton
     *
     * @var object
     */
    public $CI;

    // --------------------------------------------------------------------

    /**
     * Constructor
     *
     * @param array $params Initialization parameters
     *
     * @return void
     */
    public function __construct($params = [])
    {
        $this->CI = &get_instance();
        $this->CI->load->language('pagination');

        foreach (['first_link', 'next_link', 'prev_link', 'last_link'] as $key) {
            if (($val = $this->CI->lang->line('pagination_' . $key)) !== false) {
                $this->{$key} = $val;
            }
        }

        // _parse_attributes(), called by initialize(), needs to run at least once
        // in order to enable "rel" attributes, and this triggers it.
        isset($params['attributes']) || $params['attributes'] = [];

        $this->initialize($params);
        log_message('info', 'Pagination Class Initialized');
    }

    // --------------------------------------------------------------------

    /**
     * Initialize Preferences
     *
     * @param array $params Initialization parameters
     *
     * @return CI_Pagination
     */
    public function initialize(array $params = [])
    {
        if (isset($params['attributes']) && is_array($params['attributes'])) {
            $this->_parse_attributes($params['attributes']);
            unset($params['attributes']);
        }

        // Deprecated legacy support for the anchor_class option
        // Should be removed in CI 3.1+
        if (isset($params['anchor_class'])) {
            empty($params['anchor_class']) || $attributes['class'] = $params['anchor_class'];
            unset($params['anchor_class']);
        }

        foreach ($params as $key => $val) {
            if (property_exists($this, $key)) {
                $this->{$key} = $val;
            }
        }

        if ($this->CI->config->item('enable_query_strings') === true) {
            $this->page_query_string = true;
        }

        if ($this->use_global_url_suffix === true) {
            $this->suffix = $this->CI->config->item('url_suffix');
        }

        return $this;
    }

    // --------------------------------------------------------------------

    /**
     * Generate the pagination links
     *
     * @return string
     */
    public function create_links()
    {
        // If our item count or per-page total is zero there is no need to continue.
        // Note: DO NOT change the operator to === here!
        if ($this->total_rows === 0 || $this->per_page === 0) {
            return '';
        }

        // Calculate the total number of pages
        $num_pages = (int) ceil($this->total_rows / $this->per_page);

        // Is there only one page? Hm... nothing more to do here then.
        if ($num_pages === 1) {
            return '';
        }

        // Check the user defined number of links.
        $this->num_links = (int) $this->num_links;

        if ($this->num_links < 0) {
            show_error('Your number of links must be a non-negative number.');
        }

        // Keep any existing query string items.
        // Note: Has nothing to do with any other query string option.
        if ($this->reuse_query_string === true) {
            $get = $this->CI->input->get();

            // Unset the control, method, old-school routing options
            unset($get['c'], $get['m'], $get[$this->query_string_segment]);
        } else {
            $get = [];
        }

        // Put together our base and first URLs.
        // Note: DO NOT append to the properties as that would break successive calls
        $base_url  = trim($this->base_url);
        $first_url = $this->first_url;

        $query_string     = '';
        $query_string_sep = (strpos($base_url, '?') === false) ? '?' : '&amp;';

        // Are we using query strings?
        if ($this->page_query_string === true) {
            // If a custom first_url hasn't been specified, we'll create one from
            // the base_url, but without the page item.
            if ($first_url === '') {
                $first_url = $base_url;

                // If we saved any GET items earlier, make sure they're appended.
                if (! empty($get)) {
                    $first_url .= $query_string_sep . http_build_query($get);
                }
            }

            // Add the page segment to the end of the query string, where the
            // page number will be appended.
            $base_url .= $query_string_sep . http_build_query(array_merge($get, [$this->query_string_segment => '']));
        } else {
            // Standard segment mode.
            // Generate our saved query string to append later after the page number.
            if (! empty($get)) {
                $query_string = $query_string_sep . http_build_query($get);
                $this->suffix .= $query_string;
            }

            // Does the base_url have the query string in it?
            // If we're supposed to save it, remove it so we can append it later.
            if ($this->reuse_query_string === true && ($base_query_pos = strpos($base_url, '?')) !== false) {
                $base_url = substr($base_url, 0, $base_query_pos);
            }

            if ($first_url === '') {
                $first_url = $base_url . $query_string;
            }

            $base_url = rtrim($base_url, '/') . '/';
        }

        // Determine the current page number.
        $base_page = ($this->use_page_numbers) ? 1 : 0;

        // Are we using query strings?
        if ($this->page_query_string === true) {
            $this->cur_page = $this->CI->input->get($this->query_string_segment);
        } elseif (empty($this->cur_page)) {
            // Default to the last segment number if one hasn't been defined.
            if ($this->uri_segment === 0) {
                $this->uri_segment = count($this->CI->uri->segment_array());
            }

            $this->cur_page = $this->CI->uri->segment($this->uri_segment);

            // Remove any specified prefix/suffix from the segment.
            if ($this->prefix !== '' || $this->suffix !== '') {
                $this->cur_page = str_replace([$this->prefix, $this->suffix], '', $this->cur_page);
            }
        } else {
            $this->cur_page = (string) $this->cur_page;
        }

        // If something isn't quite right, back to the default base page.
        if (! ctype_digit($this->cur_page) || ($this->use_page_numbers && (int) $this->cur_page === 0)) {
            $this->cur_page = $base_page;
        } else {
            // Make sure we're using integers for comparisons later.
            $this->cur_page = (int) $this->cur_page;
        }

        // Is the page number beyond the result range?
        // If so, we show the last page.
        if ($this->use_page_numbers) {
            if ($this->cur_page > $num_pages) {
                $this->cur_page = $num_pages;
            }
        } elseif ($this->cur_page > $this->total_rows) {
            $this->cur_page = ($num_pages - 1) * $this->per_page;
        }

        $uri_page_number = $this->cur_page;

        // If we're using offset instead of page numbers, convert it
        // to a page number, so we can generate the surrounding number links.
        if (! $this->use_page_numbers) {
            $this->cur_page = (int) floor(($this->cur_page / $this->per_page) + 1);
        }

        // Calculate the start and end numbers. These determine
        // which number to start and end the digit links with.
        $start = (($this->cur_page - $this->num_links) > 0) ? $this->cur_page - ($this->num_links - 1) : 1;
        $end   = (($this->cur_page + $this->num_links) < $num_pages) ? $this->cur_page + $this->num_links : $num_pages;

        // And here we go...
        $output = '';

        // Render the "First" link.
        if ($this->first_link !== false && $this->cur_page > ($this->num_links + 1 + ! $this->num_links)) {
            // Take the general parameters, and squeeze this pagination-page attr in for JS frameworks.
            $attributes = sprintf('%s %s="%d"', $this->_attributes, $this->data_page_attr, 1);

            $output .= $this->first_tag_open . '<a href="' . $first_url . '"' . $attributes . $this->_attr_rel('start') . '>'
                . $this->first_link . '</a>' . $this->first_tag_close;
        }

        // Render the "Previous" link.
        if ($this->prev_link !== false && $this->cur_page !== 1) {
            $i = ($this->use_page_numbers) ? $uri_page_number - 1 : $uri_page_number - $this->per_page;

            $attributes = sprintf('%s %s="%d"', $this->_attributes, $this->data_page_attr, ($this->cur_page - 1));

            if ($i === $base_page) {
                // First page
                $output .= $this->prev_tag_open . '<a href="' . $first_url . '"' . $attributes . $this->_attr_rel('prev') . '>'
                    . $this->prev_link . '</a>' . $this->prev_tag_close;
            } else {
                $append = $this->prefix . $i . $this->suffix;
                $output .= $this->prev_tag_open . '<a href="' . $base_url . $append . '"' . $attributes . $this->_attr_rel('prev') . '>'
                    . $this->prev_link . '</a>' . $this->prev_tag_close;
            }
        } elseif ($this->display_prev_link && $this->cur_page === 1) {
            $output .= $this->prev_tag_open . $this->dead_tag_prev_open . $this->prev_link . $this->dead_tag_prev_close . $this->next_tag_close;
        }

        // Render the pages
        if ($this->display_pages !== false) {
            // Write the digit links
            for ($loop = $start - 1; $loop <= $end; $loop++) {
                $i = ($this->use_page_numbers) ? $loop : ($loop * $this->per_page) - $this->per_page;

                $attributes = sprintf('%s %s="%d"', $this->_attributes, $this->data_page_attr, $loop);

                if ($i >= $base_page) {
                    if ($this->cur_page === $loop) {
                        // Current page
                        $output .= $this->cur_tag_open . $loop . $this->cur_tag_close;
                    } elseif ($i === $base_page) {
                        // First page
                        $output .= $this->num_tag_open . '<a href="' . $first_url . '"' . $attributes . $this->_attr_rel('start') . '>'
                            . $loop . '</a>' . $this->num_tag_close;
                    } else {
                        $append = $this->prefix . $i . $this->suffix;
                        $output .= $this->num_tag_open . '<a href="' . $base_url . $append . '"' . $attributes . '>'
                            . $loop . '</a>' . $this->num_tag_close;
                    }
                }
            }
        }

        // Render the "next" link
        if ($this->next_link !== false && $this->cur_page < $num_pages) {
            $i = ($this->use_page_numbers) ? $this->cur_page + 1 : $this->cur_page * $this->per_page;

            $attributes = sprintf('%s %s="%d"', $this->_attributes, $this->data_page_attr, $this->cur_page + 1);

            $output .= $this->next_tag_open . '<a href="' . $base_url . $this->prefix . $i . $this->suffix . '"' . $attributes
                . $this->_attr_rel('next') . '>' . $this->next_link . '</a>' . $this->next_tag_close;
        } elseif ($this->display_next_link && $this->cur_page >= $num_pages) {
            $output .= $this->next_tag_open . $this->dead_tag_next_open . $this->next_link . $this->dead_tag_next_close . $this->next_tag_close;
        }

        // Render the "Last" link
        if ($this->last_link !== false && ($this->cur_page + $this->num_links + ! $this->num_links) < $num_pages) {
            $i = ($this->use_page_numbers) ? $num_pages : ($num_pages * $this->per_page) - $this->per_page;

            $attributes = sprintf('%s %s="%d"', $this->_attributes, $this->data_page_attr, $num_pages);

            $output .= $this->last_tag_open . '<a href="' . $base_url . $this->prefix . $i . $this->suffix . '"' . $attributes . '>'
                . $this->last_link . '</a>' . $this->last_tag_close;
        }

        // Kill double slashes. Note: Sometimes we can end up with a double slash
        // in the penultimate link so we'll kill all double slashes.
        $output = preg_replace('#([^:"])//+#', '\\1/', $output);

        // Add the wrapper HTML if exists
        return $this->full_tag_open . $output . $this->full_tag_close;
    }

    // --------------------------------------------------------------------

    /**
     * Parse attributes
     *
     * @param array $attributes
     *
     * @return void
     */
    protected function _parse_attributes($attributes)
    {
        isset($attributes['rel']) || $attributes['rel'] = true;
        $this->_link_types                              = ($attributes['rel'])
            ? ['start' => 'start', 'prev' => 'prev', 'next' => 'next']
            : [];
        unset($attributes['rel']);

        $this->_attributes = '';

        foreach ($attributes as $key => $value) {
            $this->_attributes .= ' ' . $key . '="' . $value . '"';
        }
    }

    // --------------------------------------------------------------------

    /**
     * Add "rel" attribute
     *
     * @see	http://www.w3.org/TR/html5/links.html#linkTypes
     *
     * @param string $type
     *
     * @return string
     */
    protected function _attr_rel($type)
    {
        if (isset($this->_link_types[$type])) {
            unset($this->_link_types[$type]);

            return ' rel="' . $type . '"';
        }

        return '';
    }
}
