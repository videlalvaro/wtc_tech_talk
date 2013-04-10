<?php

# Step 2: remove the if that checks the $user variable type
# and we use a Type Hint on the method declaration

public function toggleReadBooks($guids, MyUserInterface $user)
{
    $filteredGuids = filter_read_books($guids, $user->getReadBooks());

    if (!empty($filteredGuids)) {
        $userData = $this->readBooksById($filteredGuids, $user);

        if (!empty($userData)) {
            $user->fromArray($userData);
        }
    }
}
