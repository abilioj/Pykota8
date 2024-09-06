<?php

/**
 * @package URI Base
 * Classe ideal para ajudar a pegar a url base de um projeto automaticamente
 * independente de onde estiver instalado, esta classe se responsabiliza de obter a url base principal.
 *
 * @author  Rafael Andrade | web.andrade@hotmail.com
 * @version  1.0
 * @copyright 2016
 *
 * @access public
 * @var string
 */

class URI
{

	/**
	 * $protocolo
	 * @var string | $protocolo
	 * @access private
	 */
	private static string $protocolo;

	/**
	 * $host
	 * @var string | $host
	 * @access private
	 */
	private static string $host;

	/**
	 * $scriptName
	 * @var string | $scriptName
	 * @access private
	 */
	private static string $scriptName;

	/**
	 * $finalBase
	 * @var string | $finalBase
	 * @access private
	 */
	private static string $finalBase;

	
	/**
	 * protected function Protocolo()
	 * ----------------------------------------------
	 * 			  Obtém o protocolo da url
	 * ----------------------------------------------
	 * @return string | Ex: http://... - https://...
	 * @access protected
	 */
	protected static function Protocolo(): string
	{
		/**
		 * Faz a verificação se for
		 * diferente de https
		 */
		if (strpos(strtolower($_SERVER['SERVER_PROTOCOL']), 'https') === false) {
			self::$protocolo = 'http://'; //Atribui o valor http
		} else {
			self::$protocolo = 'https://'; //Atribui o valor https
		}

		/**
		 * Retorna o protocolo em formato string
		 * @var string
		 */
		return self::$protocolo;
	}

	/**
	 * protected function Host()
	 * ----------------------------------------------
	 * 			  Obtém o host principal
	 * ----------------------------------------------
	 * @return string | Ex: www.example.com.br
	 * @access protected
	 */
	protected static function Host(): string
	{
		self::$host = $_SERVER['HTTP_HOST']; //Atribui o valor www.example.com.br

		/**
		 * Retorna o host em formato string
		 * @var string
		 */
		return self::$host;
	}

	/**
	 * protected function scriptName()
	 * ----------------------------------------------
	 * Obtém o script name do host após a primeira barra
	 * ----------------------------------------------
	 * @return string | Ex: .../dir/index.php
	 * @access protected
	 */
	protected static function scriptName(): string
	{
		/**
		 * $scr
		 * Atribui o valor do SCRIPT_NAME em uma
		 * variável $scr e utiliza-se a função dirname()
		 * para remover qualquer nome de arquivo .html, .php, etc...
		 * @var string
		 */
		$scr = dirname($_SERVER['SCRIPT_NAME']);

		/**
		 * Faz a contagem de barras que contém a url principal
		 * o objetivo aqui é pegar o nível de pasta onde hospeda-se o diretório
		 * caso ele exista.
		 */
		if (!empty($scr) || substr_count($scr, '/') > 1) {
			self::$scriptName = $scr . '/'; //atribui o valor do diretório com uma "/" na sequência
		} else {
			self::$scriptName = ''; //atribui um valor vazio
		}

		/**
		 * Retorna o scriptName em formato string
		 * @var string
		 */
		return self::$scriptName;
	}

	/**
	 * public function base()
	 * ----------------------------------------------
	 * 			Monta a url base e retorna
	 * ----------------------------------------------
	 * @return string
	 * @access public
	 */
	public static function base(): string
	{
		//Concatena os valores
		self::$finalBase = self::Protocolo() . self::Host() . self::scriptName();

		/**
		 * Retorna toda a url construida em formato string
		 * @var string
		 */
		return self::$finalBase;
	}
}

