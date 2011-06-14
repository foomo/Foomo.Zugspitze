<?php

namespace Foomo\Zugspitze\Services\Logger;

class Capabilities
{
	/**
	 * A URL-encoded string that specifies values for each Capabilities property.
	 * 
	 * @var string
	 */
	public $serverString;
	/**
	 * Specifies whether access to the user's camera and microphone has been administratively prohibited (true) or allowed (false).
	 *
	 * @var boolean
	 */
    public $avHardwareDisable;
	/**
	 * Specifies whether the system supports (true) or does not support (false) communication with accessibility aids.
	 *
	 * @var boolean
	 */
    public $hasAccessibility;
	/**
	 * Specifies whether the system has audio capabilities.
	 *
	 * @var boolean
	 */
    public $hasAudio;
	/**
	 * Specifies whether the system can (true) or cannot (false) encode an audio stream, such as that coming from a microphone.
	 *
	 * @var boolean
	 */
    public $hasAudioEncoder;
	/**
	 * Specifies whether the system supports (true) or does not support (false) embedded video.
	 *
	 * @var boolean
	 */
    public $hasEmbeddedVideo;
	/**
	 * Specifies whether the system does (true) or does not (false) have an input method editor (IME) installed.
	 *
	 * @var boolean
	 */
	public $hasIME;
	/**
	 * Specifies whether the system does (true) or does not (false) have an MP3 decoder.
	 *
	 * @var boolean
	 */
	public $hasMP3;
	/**
	 * Specifies whether the system does (true) or does not (false) support printing.
	 *
	 * @var boolean
	 */
	public $hasPrinting;
	/**
	 * Specifies whether the system does (true) or does not (false) support the development of screen broadcast applications to be run through Flash Media Server.
	 *
	 * @var boolean
	 */
	public $hasScreenBroadcast;
	/**
	 * Specifies whether the system does (true) or does not (false) support the playback of screen broadcast applications that are being run through Flash Media Server.
	 *
	 * @var boolean
	 */
	public $hasScreenPlayback;
	/**
	 * Specifies whether the system can (true) or cannot (false) play streaming audio.
	 *
	 * @var boolean
	 */
	public $hasStreamingAudio;
	/**
	 * Specifies whether the system can (true) or cannot (false) play streaming video.
	 *
	 * @var boolean
	 */
	public $hasStreamingVideo;
	/**
	 * Specifies whether the system supports native SSL sockets through NetConnection (true) or does not (false).
	 *
	 * @var boolean
	 */
	public $hasTLS;
	/**
	 * Specifies whether the system can (true) or cannot (false) encode a video stream, such as that coming from a web camera.
	 *
	 * @var boolean
	 */
	public $hasVideoEncoder;
	/**
	 * Specifies whether the system is a special debugging version (true) or an officially released version (false).
	 *
	 * @var boolean
	 */
	public $isDebugger;
	/**
	 * Specifies the language code of the system on which the content is running.
	 *
	 * @var string
	 */
	public $language;
	/**
	 * Specifies whether read access to the user's hard disk has been administratively prohibited (true) or allowed (false).
	 *
	 * @var boolean
	 */
	public $localFileReadDisable;
	/**
	 * Specifies the manufacturer of the running version of Flash Player or the AIR runtime, in the format "Adobe OSName".
	 *
	 * @var string
	 */
	public $manufacturer;
	/**
	 * Retrieves the highest H.264 Level IDC that the client hardware supports.
	 *
	 * @var string
	 */
	public $maxLevelIDC;
	/**
	 * Specifies the current operating system.
	 *
	 * @var string
	 */
	public $os;
	/**
	 * @var integer
	 */
	public $pixelAspectRatio;
	/**
	 * Specifies the type of runtime environment.
	 *
	 * @var string
	 */
	public $playerType;
	/**
	 * Specifies the screen color.
	 *
	 * @var string
	 */
	public $screenColor;
	/**
	 * Specifies the dots-per-inch (dpi) resolution of the screen, in pixels.
	 *
	 * @var integer
	 */
	public $screenDPI;
	/**
	 * Specifies the maximum horizontal resolution of the screen.
	 *
	 * @var integer
	 */
	public $screenResolutionX;
	/**
	 * Specifies the maximum vertical resolution of the screen.
	 *
	 * @var integer
	 */
	public $screenResolutionY;
	/**
	 * Specifies whether the system supports running 32-bit processes. The server string is PR32.
	 *
	 * @var boolean
	 */
	public $supports32BitProcesses;
	/**
	 * Specifies whether the system supports running 64-bit processes. The server string is PR64.
	 *
	 * @var boolean
	 */
	public $supports64BitProcesses;
	/**
	 * Specifies the Flash Player or Adobe¬Æ AIR¬Æ platform and version information.
	 *
	 * @var string
	 */
	public $version;
}