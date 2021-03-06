<?php

namespace masterix21\html2pdf;

use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Support\Arr;
use Spipu\Html2Pdf\Html2Pdf;

class PDF
{
    protected $view;

    public function __construct(ViewFactory $view)
    {
        $this->view = $view;
    }

    /**
     * Init html2pdf constructor
     *
     * @param array $config
     * @return \HTML2PDF
     */
    private function init($config=[])
    {
        if (empty($config) || !is_array($config))
            $config = [];

        $html2pdf = new Html2Pdf(
            Arr::get($config, 'orientation', config('html2pdf.orientation')),
            Arr::get($config, 'format', config('html2pdf.format')),
            config('app.locale'),
            Arr::get($config, 'unicode', config('html2pdf.unicode')),
            Arr::get($config, 'encoding', config('html2pdf.encoding')),
            Arr::get($config, 'margins', config('html2pdf.margins'))
        );

        return $html2pdf;
    }

    /**
     * Send the PDF document in browser with a specific name
     *
     * @param $name
     * @param $view
     * @param array $data
     * @param array $mergeData
     * @param array $config
     * @return string
     */
    public function render($name, $view, $data=[], $mergeData=[], $config=[])
    {
        $html2pdf = $this->init($config);
        $html2pdf->writeHTML($this->view->make($view, $data, $mergeData));
        return $html2pdf->Output($name);
    }

    /**
     * Forcing the download of PDF via web browser, with a specific name
     *
     * @param $name
     * @param $view
     * @param array $data
     * @param array $mergeData
     * @param array $config
     * @return string
     */
    public function download($name, $view, $data=[], $mergeData=[], $config=[])
    {
        $html2pdf = $this->init($config);
        $html2pdf->writeHTML($this->view->make($view, $data, $mergeData));
        return $html2pdf->Output($name, 'D');
    }

    /**
     * Save PDF on server
     *
     * @param $path
     * @param $view
     * @param array $data
     * @param array $mergeData
     * @param array $config
     * @return string
     */
    public function save($path, $view, $data=[], $mergeData=[], $config=[])
    {
        $html2pdf = $this->init($config);
        $html2pdf->writeHTML($this->view->make($view, $data, $mergeData));
        return $html2pdf->Output($path, 'F');
    }
}
