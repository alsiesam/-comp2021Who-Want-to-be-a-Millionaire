/*
 * avl.cpp
 */

#ifndef AVL_CPP
#define AVL_CPP



/* Goal: To find the balance factor of an AVL tree
 *       balance factor = height of right sub-tree - height of left sub-tree
 * Return: (int) balance factor
 */
template <typename T, typename K>
int AVL<T,K>::bfactor() const
{
    if (this->is_empty()) 
        return 0;

    int left_avl_height = -1;  // Default height for empty subtree
    int right_avl_height = -1; // Default height for empty subtree
        
    if (this->left_subtree())
        left_avl_height = this->left_subtree()->height();

    if (this->right_subtree())
        right_avl_height = this->right_subtree()->height();

    return (right_avl_height - left_avl_height);
}


/* Goal: To rectify the height values of each node of of an AVL tree */
template <typename T, typename K>
void AVL<T,K>::fix_height() const
{
    if (!this->is_empty())
    {
        int left_avl_height = -1;  // Default height for empty subtree
        int right_avl_height = -1; // Default height for empty subtree
        
        if (this->left_subtree())
            left_avl_height = this->left_subtree()->height();

        if (this->right_subtree())
            right_avl_height = this->right_subtree()->height();
        
        this->root->bt_height = 1 + max(left_avl_height, right_avl_height);
    }
}


/* Goal: To perform a single left (anti-clocwise) rotation of the root */
template <typename T, typename K>
void AVL<T,K>::rotate_left() // The calling AVL node is node a
{
    AVL* b = dynamic_cast<AVL*>(this->right_subtree()); // Points to node b
    this->root->right = b->left_subtree();
    fix_height();       // Fix the height of node a

    swap(this->root, b->root);     // Node b becomes the new root
    this->root->left = b;    // Note: old node b becomes a
    fix_height();       // Fix the height of node b, now root of the whole AVL
}


/* Goal: To perform right (clockwise) rotation of the root */
template <typename T, typename K>
void AVL<T,K>::rotate_right() // The calling AVL node is node a
{
    AVL* b = dynamic_cast<AVL*>(this->left_subtree()); // Points to node b
    this->root->left = b->right_subtree();
    fix_height();       // Fix the height of node a

    swap(this->root, b->root);     // Node b becomes the new root
    this->root->right = b;    // Note: old node b becomes a
    fix_height();       // Fix the height of node b, now root of the whole AVL
}

/* Goal: To balance an AVL tree */
template <typename T, typename K>
void AVL<T,K>::balance()
{
    if (this->is_empty())
        return;

    fix_height();
    int balance_factor = bfactor();

    if (balance_factor == 2)       // Right subtree is taller by 2
    {
        AVL* right_avl = dynamic_cast<AVL*>(this->right_subtree());
        
        if (right_avl->bfactor() < 0) // Case 2: insertion to the L of RT
            right_avl->rotate_right();

        rotate_left();      // Cases 1 or 2: Insertion to the R/L of RT
    }

    else if (balance_factor == -2) // Left subtree is taller by 2
    {
        AVL* left_avl = dynamic_cast<AVL*>(this->left_subtree());
        if (left_avl->bfactor() > 0) // Case 4: insertion to the R of LT
            left_avl->rotate_left();

        rotate_right();     // Cases 3 or 4: insertion to the L/R of LT
    }
    // Balancing is not required for the remaining cases
}


/* Goal: To insert an item x with key k to AVL tree*/
template <typename T, typename K>
void AVL<T,K>::insert(const T& x, const K& k)
{
    if (this->is_empty())  // Find the spot
        this->root = new bt_node(x, k);

    else if (k < this->root->key)
    {
        if (!this->left_subtree()) // Create a BST node first
            this->left_subtree() = new AVL;
        
        this->left_subtree()->insert(x, k);
    }

    else if (k > this->root->key)
    {
        if (!this->right_subtree()) // Create a BST node first
            this->right_subtree() = new AVL;

        this->right_subtree()->insert(x, k);
    }
    
    balance();
}



/* Goal: To remove an item with key k in AVL tree */
template <typename T, typename K>
void AVL<T,K>::remove(const K& k)
{
    if (this->is_empty())        // Item is not found; do nothing
        return;

    AVL* left_avl = dynamic_cast<AVL*>(this->left_subtree());
    AVL* right_avl = dynamic_cast<AVL*>(this->right_subtree());
    
    if (k < this->root->key)
    {
        if (left_avl)
            left_avl->remove(k);  // Recursion on the left sub-tree
    }
    
    else if (k > this->root->key)
    {
        if (right_avl)
            right_avl->remove(k); // Recursion on the right sub-tree
    }

    else if (left_avl && right_avl)   // Found node has 2 children
    {
        AVL* min_avl = dynamic_cast<AVL*>(right_avl->find_min());
        this->root->key = min_avl->root->key;
        this->root->value = min_avl->root->value;
        right_avl->remove(this->root->key);
    }

    else // Found node has 0 or 1 child
    {
        // Save the root to delete first
        bt_node* deleting_node = this->root;

        if (!left_avl && !right_avl)
        {
            this->root = NULL;
        }
        
        else if (!left_avl) 
        {
            this->root = right_avl->root;
            dynamic_cast<AVL*>(deleting_node->right)->root = NULL;
        }

        else // !right_avl
        {
            this->root = left_avl->root;
            dynamic_cast<AVL*>(deleting_node->left)->root = NULL;
        }
        
        delete deleting_node;
    }

    balance();
}



#endif /* AVL_CPP */
