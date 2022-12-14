<?php

declare(strict_types=1);
/**
 * @copyright Copyright (c) 2022 Robin Appelman <robin@icewind.nl>
 *
 * @license GNU AGPL version 3 or any later version
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace OCA\Photos\Sabre\Album;

use OCA\Photos\Album\AlbumWithFiles;
use OCA\Photos\Service\UserConfigService;
use Sabre\DAV\Exception\Forbidden;
use OCP\IGroupManager;
use OCA\Photos\Album\AlbumMapper;
use OCP\Files\IRootFolder;
use OCP\IUser;

class SharedAlbumsHome extends AlbumsHome {
	private IGroupManager $groupManager;

	public function __construct(
		array $principalInfo,
		AlbumMapper $albumMapper,
		IUser $user,
		IRootFolder $rootFolder,
		IGroupManager $groupManager,
		UserConfigService $userConfigService

	) {
		parent::__construct(
			$principalInfo,
			$albumMapper,
			$user,
			$rootFolder,
			$userConfigService
		);

		$this->groupManager = $groupManager;
	}

	public function getName(): string {
		return 'sharedalbums';
	}

	/**
	 * @return never
	 */
	public function createDirectory($name) {
		throw new Forbidden('Not allowed to create folders in this folder');
	}

	/**
	 * @return AlbumRoot[]
	 */
	public function getChildren(): array {
		if ($this->children === null) {
			$albums = $this->albumMapper->getSharedAlbumsForCollaboratorWithFiles($this->user->getUID(), AlbumMapper::TYPE_USER);

			$userGroups = $this->groupManager->getUserGroupIds($this->user);
			foreach ($userGroups as $groupId) {
				$albumsForGroup = $this->albumMapper->getSharedAlbumsForCollaboratorWithFiles($groupId, AlbumMapper::TYPE_GROUP);
				$albumsForGroup = array_udiff($albumsForGroup, $albums, fn ($a, $b) => $a->getAlbum()->getId() - $b->getAlbum()->getId());
				$albums = array_merge($albums, $albumsForGroup);
			}

			$this->children = array_map(function (AlbumWithFiles $folder) {
				return new SharedAlbumRoot($this->albumMapper, $folder, $this->rootFolder, $this->userFolder, $this->user, $this->userConfigService);
			}, $albums);
			;
		}

		return $this->children;
	}
}
