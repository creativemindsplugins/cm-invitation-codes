<?php
namespace com\cminds\registration\model;

use com\cminds\registration\App;

class InvitationCode extends PostType {
	
	const POST_TYPE = 'cmreg_invitcode';
	const META_S2MEMBERS_LEVEL = 'cmreg_s2members_level';
	const META_CODE_STRING = 'cmreg_code_string';
	const META_EXPIRATION = 'cmreg_expiration';
	const META_USERS_LIMIT = 'cmreg_users_limit';
	const META_USERS_COUNT = 'cmreg_users_count';
	const META_EMAIL_VERIFICATION_STATUS = 'cmreg_email_verification_status';
	const META_USER_ROLE = 'cmreg_user_role';
	const META_REQUIRED_EMAIL = 'cmreginv_email';
	const META_LOGIN_REDIRECTION_URL = 'cmreginv_login_redirection_url';
	const META_CMDM_USER_GROUP = 'cmreg_cmdm_user_group';

	const CODE_LENGTH = 10;
	
	const EMAIL_VERIFICATION_NO = 'no';
	const EMAIL_VERIFICATION_YES = 'yes';
	const EMAIL_VERIFICATION_GLOBAL = 'global';
	
	static protected $postTypeOptions = [
        'label' => 'Invitation Code',
        'public' => false,
        'exclude_from_search' => true,
        'publicly_queryable' => false,
        'show_ui' => true,
        'show_in_admin_bar' => true,
        'show_in_menu' => App::SLUG,
        'hierarchical' => false,
        'supports' => ['title'],
        'has_archive' => true,
    ];
	
	static protected function getPostTypeLabels() {
		$singular = ucfirst('Invitation Code');
		$plural = ucfirst('Invitation Codes');
		return [
			'name' => $plural,
			'singular_name' => $singular,
			'add_new' => sprintf(__('Add %s', App::SLUG), $singular),
			'add_new_item' => sprintf(__('Add New %s', App::SLUG), $singular),
			'edit_item' => sprintf(__('Edit %s', App::SLUG), $singular),
			'new_item' => sprintf(__('New %s', App::SLUG), $singular),
			'all_items' => $plural,
			'view_item' => sprintf(__('View %s', App::SLUG), $singular),
			'search_items' => sprintf(__('Search %s', App::SLUG), $plural),
			'not_found' => sprintf(__('No %s found', App::SLUG), $plural),
			'not_found_in_trash' => sprintf(__('No %s found in Trash', App::SLUG), $plural),
			'menu_name' => App::getPluginName()
        ];
	}
	
	static function init() {
		parent::init();
	}
	
	/**
	 * Get instance
	 *
	 * @param WP_Post|int $post Post object or ID
	 * @return com\cminds\registration\model\InvitationCode
	 */
	static function getInstance($post): InvitationCode {
		return parent::getInstance($post);
	}
	
	static function getByCode($code) {
		global $wpdb;
		if (empty($code)) return null;
		$postId = $wpdb->get_var($wpdb->prepare("SELECT pm.post_id FROM $wpdb->postmeta as pm, $wpdb->posts as p WHERE p.ID=pm.post_id and p.post_status='publish' and pm.meta_key = %s AND pm.meta_value = %s", static::META_CODE_STRING, $code));
		if ($postId) {
			return static::getInstance($postId);
		}

        return new static(null);
	}
	
	static function getByUser($userId) {
		global $wpdb;
		$sql = $wpdb->prepare("SELECT meta_value
			FROM $wpdb->usermeta
			WHERE meta_key = %s AND user_id = %d",
			User::META_INVITATION_CODE,
			$userId
		);
		$postId = $wpdb->get_var($sql);
		if ($postId) {
			return static::getInstance($postId);
		}
	}

	function getEditUrl() {
		return admin_url(sprintf('post.php?action=edit&post=%d',
			$this->getId()
		));
	}
	
	function getS2MembersLevel() {
		return $this->getPostMeta(static::META_S2MEMBERS_LEVEL);
	}
	
	function setS2MembersLevel($level) {
		return $this->setPostMeta(static::META_S2MEMBERS_LEVEL, $level);
	}

	function getCodeString() {
		return $this->getPostMeta(static::META_CODE_STRING);
	}
			
	function setCodeString($value) {
		return $this->setPostMeta(static::META_CODE_STRING, $value);
	}
	
	/**
	 * Returns term taxonomy ID
	 * @return int
	 */
	function getCMDMUserGroup() {
		return $this->getPostMeta(static::META_CMDM_USER_GROUP);
	}
	
	function setCMDMUserGroup($ttId) {
		return $this->setPostMeta(static::META_CMDM_USER_GROUP, $ttId);
	}
	
	function getRequiredEmail() {
		return $this->getPostMeta(static::META_REQUIRED_EMAIL);
	}
	
	function setRequiredEmail($value) {
		return $this->setPostMeta(static::META_REQUIRED_EMAIL, $value);
	}
	
	function getExpirationDate() {
		return $this->getPostMeta(static::META_EXPIRATION);
	}
	
	function getExpirationDateFormatted() {
		if ($time = $this->getExpirationDate()) {
            return Date('Y-m-d H:i', $time);
		}

        return '';
	}
	
	function setExpirationDate($value) {
		if (!is_numeric($value)) $value = strtotime($value);
		return $this->setPostMeta(static::META_EXPIRATION, $value);
	}
	
	function getUsersLimit() {
		return intval($this->getPostMeta(static::META_USERS_LIMIT));
	}
	
	function setUsersLimit($value) {
		return $this->setPostMeta(static::META_USERS_LIMIT, $value);
	}

	function getUsersCount() {
		return intval($this->getPostMeta(static::META_USERS_COUNT));
	}
	
	function setUsersCount($value) {
		return $this->setPostMeta(static::META_USERS_COUNT, $value);
	}
	
	function getUserRole() {
		return $this->getPostMeta(static::META_USER_ROLE);
	}
	
	function setUserRole($value) {
		return $this->setPostMeta(static::META_USER_ROLE, $value);
	}
	
	function getLoginRedirectionUrl() {
		return $this->getPostMeta(static::META_LOGIN_REDIRECTION_URL);
	}
	
	function setLoginRedirectionUrl($value) {
		return $this->setPostMeta(static::META_LOGIN_REDIRECTION_URL, $value);
	}
	
	function incrementUsersCount() {
		$count = $this->getUsersCount();
		$this->setUsersCount($count+1);
		return $this;
	}
	
	function canUse() {
		$limit = $this->getUsersLimit();
		$count = $this->getUsersCount();
		$expiration = $this->getExpirationDate();
		return ($this->getStatus() == 'publish' AND ($limit == 0 OR $limit > $count) AND (empty($expiration) OR $expiration > time()));
	}
	
	function getOrGenerateCodeString() {
		$code = $this->getCodeString();
		if (!$code) {
			$code = User::generateRandomString(self::CODE_LENGTH);
			$this->setCodeString($code);
		}
		return $code;
	}
	
	function getEmailVerificationStatus() {
		return $this->getPostMeta(static::META_EMAIL_VERIFICATION_STATUS);
	}
	
	function getEmailVerificationStatusOrGlobal() {
		$status = $this->getEmailVerificationStatus();

		if (empty($status) || $status == self::EMAIL_VERIFICATION_GLOBAL) {
			return Settings::getOption(Settings::OPTION_REGISTER_EMAIL_VERIFICATION_ENABLE);
		} else {
			return ($status == self::EMAIL_VERIFICATION_YES);
		}
	}
	
	function setEmailVerificationStatus($value) {
		return $this->setPostMeta(static::META_EMAIL_VERIFICATION_STATUS, $value);
	}
	
	function registerInvitation($userId) {
	
		$role = null;
		
		if ($this->canUse()) {
			$post = get_post($this->getId());
			update_user_meta($userId, User::META_INVITATION_CODE, $this->getId());
			update_user_meta($userId, User::META_INVITATION_CODE_STRING, $this->getCodeString());
			update_user_meta($userId, User::META_INVITATION_CODE_AUTHOR_ID, $post->post_author);
			do_action('cmreg_invitation_register_invitation', $userId, $this->getId());
			$this->incrementUsersCount();
			if (Settings::getOption(Settings::OPTION_S2MEMBERS_ENABLE) AND $level = $this->getS2MembersLevel()) {
				$role = User::ROLE_S2MEMBERS_LEVEL_PREFIX . $level;
			} else {
				$role = $this->getUserRole();
				if (empty($role) OR !User::roleExists($role)) {
					$role = Settings::getOption(Settings::OPTION_REGISTER_DEFAULT_ROLE);
				}
			}
		}
		else if (Settings::getOption(Settings::OPTION_S2MEMBERS_ENABLE) AND $level = Settings::getOption(Settings::OPTION_REGISTER_S2MEMBER_DEFAULT_LEVEL)) {
			$role = User::ROLE_S2MEMBERS_LEVEL_PREFIX . $level;
		} else {
			$role = Settings::getOption(Settings::OPTION_REGISTER_DEFAULT_ROLE);
		}
	
		if (!empty($role)) {
			if (!User::roleExists($role) AND App::TESTING) {
				add_role($role, $role, array('read'));
			}
			User::setUserRole($userId, $role);
		}
	
	}
	
	static function getByAuthor($userId) {
		$posts = get_posts(array(
			'author' => $userId,
			'post_type' => static::POST_TYPE,
			'posts_per_page' => -1,
			'post_status' => 'publish',
		));
		return array_filter(array_map(function($post) { return InvitationCode::getInstance($post); }, $posts));
	}

	static function getByAuthorLastOne($userId) {
		$posts = get_posts(array(
			'author' => $userId,
			'post_type' => static::POST_TYPE,
			'posts_per_page' => 1,
			'post_status' => 'publish',
			'orderby' => 'date',
			'order' => 'asc',
		));
		return array_filter(array_map(function($post) { return InvitationCode::getInstance($post); }, $posts));
	}

	static function getAll($query = array()) {
		$posts = get_posts(array_merge(array(
			'post_type' => InvitationCode::POST_TYPE,
			'posts_per_page' => -1,
			'post_status' => 'publish',
			'orderby' => 'id',
		), $query));
		return array_filter(array_map(function($post) {
			return InvitationCode::getInstance($post);
		}, $posts));
	}

}
