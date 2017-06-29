<?php
namespace zongphp\qrcode\build;

use BaconQrCode\Renderer\Color\Rgb;
use BaconQrCode\Renderer\Image\Png;
use BaconQrCode\Writer;

class Base {
	protected $width = 300;
	protected $height = 300;
	protected $renderer;

	public function __construct() {
		$this->renderer = new Png();
	}

	/**
	 * 设置宽度
	 *
	 * @param int $width 宽度
	 *
	 * @return $this
	 */
	public function width( $width ) {
		$this->width = $width;

		return $this;
	}

	/**
	 * 设置高度
	 *
	 * @param int $height 高度
	 *
	 * @return  $this
	 */
	public function height( $height ) {
		$this->height = $height;

		return $this;
	}

	/**
	 * 设置背景色
	 *
	 * @param $r
	 * @param $g
	 * @param $b
	 *
	 * @return $this
	 */
	public function backColor( $r, $g, $b ) {
		$this->renderer->setBackgroundColor( new Rgb( $r, $g, $b ) );

		return $this;
	}

	/**
	 * 设置前景色
	 *
	 * @param $r
	 * @param $g
	 * @param $b
	 *
	 * @return $this
	 */
	public function foreColor( $r, $g, $b ) {
		$this->renderer->setForegroundColor( new Rgb( $r, $g, $b ) );

		return $this;
	}

	/**
	 * 生成二维码图片
	 *
	 * @param string $content 内容
	 */
	public function make( $content ) {
		$this->renderer->setHeight( $this->width );
		$this->renderer->setWidth( $this->height );
		$writer = new Writer( $this->renderer );
		header( 'Content-type:image/png' );
		die( $writer->writeString( $content ) );
	}

	/**
	 * 生成二维码文件
	 *
	 * @param string $content 二维码内容
	 * @param string $fileName 文件名
	 */
	public function save( $content, $fileName ) {
		$this->renderer = new Png();
		$this->renderer->setHeight( $this->width );
		$this->renderer->setWidth( $this->height );
		$writer = new Writer( $this->renderer );

		return $writer->writeFile( $content, $fileName );
	}
}