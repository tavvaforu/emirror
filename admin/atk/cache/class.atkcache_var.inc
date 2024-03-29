<?php
/**
 * This file is part of the Achievo ATK distribution.
 * Detailed copyright and licensing information can be found
 * in the doc/COPYRIGHT and doc/LICENSE files which should be
 * included in the distribution.
 *
 * Cache class for variable (in-memory)
 *
 * @package atk
 * @subpackage cache
 *
 * @copyright (c)2008 Sandy Pleyte
 * @author Sandy Pleyte <sandy@achievo.org>
 * @license http://www.achievo.org/atk/licensing ATK Open Source License
 *
 * @version $Revision: 6309 $
 * $Id: class.atkcache_var.inc 6354 2009-04-15 02:41:21Z mvdam $
 */
atkimport("atk.cache.atkcache");

class atkCache_var extends atkCache
{
  /**
   * Expiration timestamps for each cache entry.
   * @var array
   */
  protected $m_expires = array();

  /**
   * Cache entries.
   * @var array
   */
  protected $m_entry = array();


  /**
   * constructor
   */
  public function __construct()
  {
    $this->setLifeTime($this->getCacheConfig('lifetime',3600));
  }

  /**
   * Sets cache entry data.
   *
   * @param string $key The entry ID.
   * @param mixed $data The data to write into the entry.
   * @param int $lifetime give a specific lifetime for this cache entry. When $lifetime is false the default lifetime is used.
   * @return bool True on success, false on failure.
   */
  public function set($key,$data,$lifetime=false)
  {
    if (!$this->m_active)
    {
      return false;
    }

    if($lifetime === false) $lifetime = $this->m_lifetime;
    $this->m_entry[$this->getRealKey($key)] = $data;
    $this->m_expires[$this->getRealKey($key)] = time() + $lifetime;
    return true;
  }

  /**
   * Inserts cache entry data, but only if the entry does not already exist.
   *
   * @param string $key The entry ID.
   * @param mixed $data The data to write into the entry.
   * @param int $lifetime give a specific lifetime for this cache entry. When $lifetime is false the default lifetime is used.
   * @return bool True on success, false on failure.
   */
  public function add($key,$data,$lifetime=false)
  {
    if (!$this->m_active)
    {
      return false;
    }

    if (empty($this->m_entry[$this->getRealKey($key)]))
    {
      return $this->set($key,$data,$lifetime);
    }
    else
    {
      return false;
    }
  }

  /**
   * Gets cache entry data.
   *
   * @param string $key The entry ID.
   * @return mixed Boolean false on failure, cache data on success.
   */
  public function get($key)
  {
    if (!$this->m_active)
    {
      return false;
    }

    if (!empty($this->m_entry[$this->getRealKey($key)]) && $this->m_expires[$this->getRealKey($key)] >= time())
    {
      // exists, and is within its lifetime
      return $this->m_entry[$this->getRealKey($key)];
    }
    else
    {
      // clear the entry
      unset($this->m_entry[$this->getRealKey($key)]);
      unset($this->m_expires[$this->getRealKey($key)]);
      return false;
    }
  }

  /**
   * Deletes a cache entry.
   *
   * @param string $key The entry ID.
   * @return boolean Succes
   */
  public function delete($key)
  {
    if (! $this->m_active)
    {
      return false;
    }

    unset($this->m_entry[$this->getRealKey($key)]);
    unset($this->m_expires[$this->getRealKey($key)]);
    return true;
  }

  /**
   * Removes all cache entries.
   *
   * @return boolean Succes
   */
  public function deleteAll()
  {
    if (! $this->m_active)
    {
      return false;
    }
    $this->m_entry = array();
    $this->m_expires = array();
    return true;
  }

  /**
   * Get the current cache type
   *
   * @return string atkConfig type
   */
  public function getType()
  {
    return 'var';
  }
}