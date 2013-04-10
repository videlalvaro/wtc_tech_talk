<?php

// This is the code we want to improve

public function toggleReadBooks($guids, $user)
{
    if ($user instanceof UserInterface) {
        if (method_exists($user, 'getReadBooks')) {
            $alreadyReadBooks = $user->getReadBooks();
            $guids = array_filter($guids, function($guid) use ($alreadyReadBooks) {
                    return !in_array($guid, $alreadyReadBooks);
                });

            if (!empty($guids)) {
                $userData = $this->readBooksById($guids, $user);

                if (!empty($userData)) {
                    $user->fromArray($userData);
                }
            }
        }
    }
}