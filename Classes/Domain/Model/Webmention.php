<?php

/**
 * IndieWeb publishing tools for TYPO3
 *
 * @category	Jkphl
 * @package		Jkphl_Indieweb
 * @author		Joschi Kuphal <joschi@kuphal.net> / @jkphl
 * @copyright	Copyright © 2014 Joschi Kuphal <joschi@kuphal.net> / @jkphl
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License version 2 (GPL2)
 */

namespace Jkphl\Indieweb\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Joschi Kuphal <joschi@tollwerk.de>, tollwerk GmbH
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Webmention model
 *
 * @category	Jkphl
 * @package		Jkphl_Indieweb
 * @author		Joschi Kuphal <joschi@kuphal.net> / @jkphl
 * @copyright	Copyright © 2014 Joschi Kuphal <joschi@kuphal.net> / @jkphl
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License version 2 (GPL2)
 */
class Webmention extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Parent page
	 *
	 * @var \Jkphl\Indieweb\Domain\Model\Page
	 */
	protected $pid = null;
	
	/**
	 * Hidden state
	 * 
	 * @var \boolean
	 */
	protected $hidden = false;

	/**
	 * Source URL
	 *
	 * @var \string
	 */
	protected $source = '';

	/**
	 * Target page
	 *
	 * @var \string
	 */
	protected $target = '';
	
	/**
	 * Processed state
	 *
	 * @var \DateTime
	 */
	protected $processed = NULL;
	
	/**
	 * Valid webmention
	 *
	 * @var \boolean
	 */
	protected $valid = false;
	
	/**
	 * Author name
	 * 
	 * @var \string
	 */
	protected $authorName = '';
	/**
	 * Author profile
	 * 
	 * @var \string
	 */
	protected $authorProfile = '';
	/**
	 * Author avatar
	 * 
	 * @var \string
	 */
	protected $authorAvatar = '';
	/**
	 * Entry name
	 * 
	 * @var \string
	 */
	protected $entryName = '';
	/**
	 * Entry summary
	 * 
	 * @var \string
	 */
	protected $entrySummary = '';
	/**
	 * Entry value
	 * 
	 * @var \string
	 */
	protected $entryValue = '';
	/**
	 * Entry content
	 * 
	 * @var \string
	 */
	protected $entryContent = '';
	/**
	 * Entry publish date
	 * 
	 * @var \DateTime
	 */
	protected $entryPublished = '';
	/**
	 * Entry modification date
	 *
	 * @var \DateTime
	 */
	protected $entryUpdated = '';
	/**
	 * Entry URL
	 * 
	 * @var \string
	 */
	protected $entryUrl = '';
	/**
	 * Webmention context
	 * 
	 * @var \string
	 */
	protected $context = '';
	
	/**
	 * Sets the parent page
	 * 
	 * @return \Jkphl\Indieweb\Domain\Model\Page $pid
	 */
	public function getPid2() {
		return $this->pid;
	}
	
	/**
	 * Sets the parent page
	 * 
	 * @param \Jkphl\Indieweb\Domain\Model\Page $pid
	 */
	public function setPid2(\Jkphl\Indieweb\Domain\Model\Page $pid) {
		$this->pid = $pid;
	}
	
	/**
	 * Return the hidden state
	 * 
	 * @return \boolean $hidden
	 */
	public function getHidden() {
		return $this->hidden;
	}

	/**
	 * Set the hidden state
	 * 
	 * @param \boolean $hidden
	 */
	public function setHidden($hidden) {
		$this->hidden = $hidden;
	}

	/**
	 * Returns the source
	 *
	 * @return string $source
	 */
	public function getSource() {
		return $this->source;
	}

	/**
	 * Sets the source
	 *
	 * @param string $source
	 * @return void
	 */
	public function setSource($source) {
		$this->source = $source;
	}

	/**
	 * Returns the processed
	 *
	 * @return \DateTime $processed
	 */
	public function getProcessed() {
		return $this->processed;
	}

	/**
	 * Sets the processed
	 *
	 * @param \DateTime $processed
	 * @return void
	 */
	public function setProcessed(\DateTime $processed) {
		$this->processed = $processed;
	}
	
	/**
	 * @return the $valid
	 */
	public function getValid() {
		return $this->valid;
	}

	/**
	 * @param Boolean $valid
	 */
	public function setValid($valid) {
		$this->valid = $valid;
	}

	/**
	 * @return the $target
	 */
	public function getTarget() {
		return $this->target;
	}
	
	/**
	 * @param string $target
	 */
	public function setTarget($target) {
		$this->target = $target;
	}
	
	/**
	 * @return the $authorName
	 */
	public function getAuthorName() {
		return $this->authorName;
	}

	/**
	 * @param string $authorName
	 */
	public function setAuthorName($authorName) {
		$this->authorName = $authorName;
	}

	/**
	 * @return the $authorProfile
	 */
	public function getAuthorProfile() {
		return $this->authorProfile;
	}

	/**
	 * @param string $authorProfile
	 */
	public function setAuthorProfile($authorProfile) {
		$this->authorProfile = $authorProfile;
	}

	/**
	 * @return the $authorAvatar
	 */
	public function getAuthorAvatar() {
		return $this->authorAvatar;
	}

	/**
	 * @param string $authorAvatar
	 */
	public function setAuthorAvatar($authorAvatar) {
		$this->authorAvatar = $authorAvatar;
	}

	/**
	 * @return the $entryName
	 */
	public function getEntryName() {
		return $this->entryName;
	}

	/**
	 * @param string $entryName
	 */
	public function setEntryName($entryName) {
		$this->entryName = $entryName;
	}

	/**
	 * @return the $entrySummary
	 */
	public function getEntrySummary() {
		return $this->entrySummary;
	}

	/**
	 * @param string $entrySummary
	 */
	public function setEntrySummary($entrySummary) {
		$this->entrySummary = $entrySummary;
	}

	/**
	 * @return the $entryValue
	 */
	public function getEntryValue() {
		return $this->entryValue;
	}

	/**
	 * @param string $entryValue
	 */
	public function setEntryValue($entryValue) {
		$this->entryValue = $entryValue;
	}

	/**
	 * @return the $entryContent
	 */
	public function getEntryContent() {
		return $this->entryContent;
	}

	/**
	 * @param string $entryContent
	 */
	public function setEntryContent($entryContent) {
		$this->entryContent = $entryContent;
	}

	/**
	 * @return the $entryPublished
	 */
	public function getEntryPublished() {
		return $this->entryPublished;
	}

	/**
	 * @param DateTime $entryPublished
	 */
	public function setEntryPublished($entryPublished) {
		$this->entryPublished = $entryPublished;
	}

	/**
	 * @return the $entryUpdated
	 */
	public function getEntryUpdated() {
		return $this->entryUpdated;
	}

	/**
	 * @param DateTime $entryUpdated
	 */
	public function setEntryUpdated($entryUpdated) {
		$this->entryUpdated = $entryUpdated;
	}

	/**
	 * @return the $entryUrl
	 */
	public function getEntryUrl() {
		return $this->entryUrl;
	}

	/**
	 * @param string $entryUrl
	 */
	public function setEntryUrl($entryUrl) {
		$this->entryUrl = $entryUrl;
	}

	/**
	 * @return the $context
	 */
	public function getContext() {
		return $this->context;
	}

	/**
	 * @param string $context
	 */
	public function setContext($context) {
		$this->context = $context;
	}

	/**
	 * Reset and reevaluate this webmention
	 * 
	 * @return void
	 */
	public function reset() {
		$this->setProcessed(null);
		$this->setValid(false);
		$this->setHidden(true);
	}
	
	/**
	 * Validate this webmention
	 * 
	 * @param \int $contextLength		Excerpt length
	 * @return \boolean					Webmention is valid
	 */
	public function validate($contextLength = 100) {
		$this->setValid(false);
		
		if ($this->getProcessed() === null) {
			
			// Ensure it's a text content type that is the webmention source
			$textContentType						= false;
			foreach (get_headers($this->getSource(), 1) as $header => $value) {
				if (strtolower($header) == 'content-type') {
					if (!strncmp('text', trim(strtolower($value)), 4)) {
						$textContentType			= true;
						break;
					}
				}
			}
			
			if ($textContentType) {
				
				// Retrieve the webmention source
				$source								= \Jkphl\Indieweb\Utility\Curl::httpRequest($this->getSource());
				
				// If the target is linked within the source
				if (stristr($source, $this->getTarget())) {
					while(strpos($source, $marker = md5(rand())) !== false) {}
					
					// Include the micrometa parser (and dependencies)
					require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('indieweb', 'Classes/Vendor/autoload.php');
					require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('indieweb', 'Classes/Vendor/jkphl/micrometa/src/Jkphl/Micrometa.php');
						
					// Instanciate a Microcontent meta object
					$micrometa							= new \Jkphl\Micrometa($this->getSource(), $source);
			
					// Search for a link to the target document
					$webmentionLinks					= $micrometa->xpath->query('//a[@href="'.addslashes($this->getTarget()).'"]');
			
					// If at least one link to the target page could be found
					if ($webmentionLinks->length) {
						$contextLength					= max(50, $contextLength);
						$webmentionEntryLink			= null;
						foreach ($webmentionLinks as $webmentionLink) {
								
							// Search on the ancestor-axis for an h-entry element
							foreach ($micrometa->xpath->query('ancestor::*[contains(@class, "h-entry")]') as $hEntryAncestorNode) {
								$micrometa->focus($hEntryAncestorNode);
								$webmentionEntryLink	= $webmentionLink;
								break;
							}
						}
						$webmentionEntryLink			= ($webmentionEntryLink instanceof \DOMElement) ? $webmentionEntryLink : ($webmentionLinks->length ? $webmentionLinks->item(0) : null);
						$webmentionEntryLinkContent		= $webmentionEntryLink->textContent;
						$webmentionEntryLinkContentHalf	= floor(mb_strlen($webmentionEntryLinkContent, 'UTF-8') / 2);
						$webmentionEntryLink->nodeValue	= mb_substr($webmentionEntryLinkContent, 0, $webmentionEntryLinkContentHalf, 'UTF-8').$marker.mb_substr($webmentionEntryLinkContent, $webmentionEntryLinkContentHalf, $webmentionEntryLinkContentHalf + 1, 'UTF-8');
				
						// If an h-entry item is part of the source code (implicit parsing)
						$entry							= $micrometa->item('h-entry');
						
						// Try to extract embedded author data
						$author							= ($entry instanceof \Jkphl\Micrometa\Item) ? $entry->author : null;
				
						// Try to load an external author definition if no data is embedded
						if (!($author instanceof \Jkphl\Micrometa\Item) || !$author->isOfType('http://schema.org/Person', 'http://data-vocabulary.org/Person', 'h-card')) {
							$author						= $micrometa->externalAuthor();
						}
				
						// If an author could be found
						if ($author instanceof \Jkphl\Micrometa\Item) {
							if (strlen($author->name)) {
								$this->setAuthorName(strval($author->name));
							}
							$this->setAuthorAvatar(strval($author->firstOf('photo', 'logo', 'image')));
							$this->setAuthorProfile(strval($author->url));
						}
						
						// If an h-entry item is available
						if ($entry instanceof \Jkphl\Micrometa\Item) {
								
							// If there's an explicit entry content
							$content							= $entry->content;
							if (is_array($content) && array_key_exists('html', $content)) {
								$content						= trim(strip_tags(html_entity_decode($content['html'], ENT_COMPAT | ENT_HTML401, 'UTF-8'), '<p><div><a><br>'));
								if (strlen($content)) {
									$this->setEntryContent(preg_replace("%\s+%", ' ', $content));
								}
							}
							
							// If there's an explicit summary
							$summary							= trim(strip_tags(html_entity_decode($entry->summary, ENT_COMPAT | ENT_HTML401, 'UTF-8')));
							if (strlen($summary)) {
								$this->setEntrySummary($summary);
							}
				
							// If there's an explicit name
							$name								= trim(strip_tags(html_entity_decode($entry->name, ENT_COMPAT | ENT_HTML401, 'UTF-8')));
							if (strlen($name)) {
								$this->setEntryName($name);
							}
							
							$value								= trim(strip_tags(html_entity_decode($entry->value, ENT_COMPAT | ENT_HTML401, 'UTF-8')));
							if (strlen($value)) {
								$this->setEntryValue($value);
							}
								
							// Check for a published date
							$published							= $entry->published;
							if ($published) {
								$this->setEntryPublished(new \DateTime($published));
							}
							
							// Check for an updated date
							$updated							= $entry->updated;
							if ($updated) {
								$this->setEntryUpdated(new \DateTime($updated));
							}
								
							// Check for an explicit permalink
							$url								= $entry->url;
							if ($url) {
								$this->setEntryUrl(strval(new \Jkphl\Indieweb\Utility\Url($url)));
							}
							
						// Else
						} else {
							foreach ($micrometa->xpath->query('//body') as $bodyElement) {
								$content				= trim(strip_tags(html_entity_decode($micrometa->dom->saveXML($bodyElement), ENT_COMPAT | ENT_HTML401, 'UTF-8'), '<p><div><a><br>'));
								if (strlen($content)) {
									$this->setEntryContent(preg_replace("%\s+%", ' ', $content));
								}
								break;
							}
						}
				
						$context						= '';
						
						// If an explicit content is available
						if (strlen($this->getEntryContent())) {
				
							// If the content is already short enough
							if ((strlen(strip_tags($this->getEntryContent())) - strlen($marker)) <= $contextLength) {
								$context				= str_replace($marker, '', $this->getEntryContent());
									
							// Else: if an explicit summary is available
							} elseif (strlen($this->getEntrySummary())) {
								$context				= (strlen($this->getEntrySummary()) <= $contextLength) ? $this->getEntrySummary() : $this->_ellipsize($this->getEntrySummary(), $contextLength);
									
							// Else: Shorten the content
							} else {
								$context				= $this->_ellipsize(explode($marker, $this->getEntryContent()), $contextLength);
							}
				
						// Else if an explicit summary is available
						} elseif (strlen($this->getEntrySummary())) {
							$context					= (strlen($this->getEntrySummary()) <= $contextLength) ? $this->getEntrySummary() : $this->_ellipsize($this->getEntrySummary(), $contextLength);
				
						// Else if an explicit name is available
						} elseif (strlen($this->getEntryName())) {
							$context					= (strlen($this->getEntryName()) <= $contextLength) ? $this->getEntryName() : $this->_ellipsize($this->getEntryName(), $contextLength);
				
						// Else: Use the value if available
						} elseif (strlen($this->getEntryValue())) {
							$context					= (strlen($this->getEntryValue()) <= $contextLength) ? $this->getEntryValue() : $this->_ellipsize($this->getEntryValue(), $contextLength);
						}
						
						$this->setContext($context);
						$this->setValid(true);
					}
				}
			}
			
			$this->setProcessed(new \DateTime('now'));
		}
		
		// Set hidden state
		$this->setHidden(!$this->getValid());
		
		// Invoke registered hook callbacks
		$this->_invokeHookCallbacks();
		
		// Return validity
		return $this->getValid();
	}
	
	/**
	 * Shorten a text to a specific maximum length and append / prepend an ellipsis
	 *
	 * @param \string|\array $str		Text
	 * @param \integer $maxlen			Maximum length
	 * @param \string $ellipsis			Ellipsis symbols
	 * @return \string					Ellipsized text
	 */
	protected function _ellipsize($str, $maxlen, $ellipsis = '…') {
	
		// If it's a HTML text
		if (is_array($str)) {
			$beginLengthLimit		= floor($maxlen / 2);
			$endLengthLimit			= $maxlen - $beginLengthLimit;
			$ellipsisLength			= mb_strlen($ellipsis, 'UTF-8');
			$beginLength			= mb_strlen(ltrim(strip_tags($str[0])), 'UTF-8');
			$endLength				= mb_strlen(rtrim(strip_tags($str[1])), 'UTF-8');
				
			// If the content has to be truncated in the beginning
			if ($beginLength > $beginLengthLimit) {
				$begin				= '';
				$length				= 0;
				$truncate			= false;
				$chunks				= preg_split("%(\<[^\>]+\>)%u", $str[0], null, PREG_SPLIT_DELIM_CAPTURE);
				foreach (array_reverse($chunks) as $chunk) {
					if (strncmp($chunk, '<', 1)) {
						if (!$truncate) {
							foreach (array_reverse(preg_split("%\b%u", $chunk)) as $subchunk) {
								$subchunkLength			= mb_strlen($subchunk, 'UTF-8');
								if (($length + $subchunkLength + $ellipsisLength) <= $beginLengthLimit) {
									$begin				= $subchunk.$begin;
									$length				+= $subchunkLength;
								} else {
									$begin				= $ellipsis.$begin;
									$length				+= $ellipsisLength;
									$truncate			= true;
									break;
								}
							}
						}
					} else {
						$begin		= $chunk.$begin;
					}
				}
				$str[0]				= $begin;
				$endLengthLimit		= $maxlen - $length;
			}
			
			// If the content has to be truncated in the end
			if ($endLength > $endLengthLimit) {
				$end				= '';
				$length				= 0;
				$truncate			= false;
				$chunks				= preg_split("%(\<[^\>]+\>)%u", $str[1], null, PREG_SPLIT_DELIM_CAPTURE);
				foreach ($chunks as $chunk) {
					if (strncmp($chunk, '<', 1)) {
						if (!$truncate) {
							foreach (preg_split("%\b%u", $chunk) as $subchunk) {
								$subchunkLength			= mb_strlen($subchunk, 'UTF-8');
								if (($length + $subchunkLength + $ellipsisLength) <= $endLengthLimit) {
									$end				.= $subchunk;
									$length				+= $subchunkLength;
								} else {
									$end				.= $ellipsis;
									$length				+= $ellipsisLength;
									$truncate			= true;
									break;
								}
							}
						}
					} else {
						$end		.= $chunk;
					}
				}
				$str[1]				= $end;
			}
				
			return $this->_tidyHtml(implode('', $str));
				
		// Else: Truncate at the end
		} else {
			$str					= mb_substr($str, 0, $maxlen - mb_strlen($ellipsis, 'UTF-8'), 'UTF-8');
			$str					= preg_match("%(.*)\W(.*?)$%", $str, $parts) ? $parts[1].$ellipsis : $str.$ellipsis;
		}
	
		return $str;
	}

	/**
	 * Tidy HMTL source code
	 *
	 * @param \string $html			HTML source code
	 * @return \string				Tidied HTML source code
	 */
	protected function _tidyHtml($html) {
		$dom						= new \DOMDocument();
		@$dom->loadHTML('<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head><body>'.$html.'</body></html>');
		$xpath						= new \DOMXPath($dom);
	
		// Remove all empty elements
		foreach ($xpath->query('//*[.=""]') as $emptyElement) {
			$emptyElement->parentNode->removeChild($emptyElement);
		}
	
		// Remove all disallowed attributes
		foreach ($xpath->query('//@*[local-name(.) != "href" and local-name(.) != "target"]') as $disallowedAttribute) {
			$disallowedAttribute->parentNode->removeAttribute($disallowedAttribute->localName);
		}
	
		// Remove all nodes that dont have mixed content
		foreach ($xpath->query('//*[local-name(.) != "html" and local-name(.) != "body"][count(text()) = 0]') as $nonMixedContent) {
			while($nonMixedContent->childNodes->length) {
				$nonMixedContent->parentNode->insertBefore($nonMixedContent->childNodes->item(0), $nonMixedContent);
			}
			$nonMixedContent->parentNode->removeChild($nonMixedContent);
		}
	
		// Add a nofollow-rel-Attribute to all Links
		foreach ($xpath->query('//a') as $link) {
			$link->setAttribute('rel', 'nofollow');
		}
	
		$html						= '';
		foreach ($dom->documentElement->childNodes->item(0)->childNodes as $element) {
			$html					.= $dom->saveXML($element);
		}
		return $html;
	}
	
	/**
	 * Invoke registered hook callbacks
	 * 
	 * @return void
	 */
	protected function _invokeHookCallbacks() {
		
		// Call post processing function for this webmention
		if (is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['indieweb']['webmention-PostProc'])) {
			$_params = array('webmention' => &$this);
			foreach ($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['indieweb']['webmention-PostProc'] as $_funcRef) {
				\TYPO3\CMS\Core\Utility\GeneralUtility::callUserFunction($_funcRef, $_params, $this);
			}
		}
	}
}