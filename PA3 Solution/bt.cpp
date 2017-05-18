/*
 * bt.cpp
 *
 */

#ifndef BT_CPP
#define BT_CPP


/* Goal: Do preorder traversal on the tree
 * Remark: print both value and key fields of each node
 */
template <typename T, typename K>
void BT<T,K>::preorder_traversal() const
{
    if (this->is_empty())
        return;

    cout << "Key: " << this->root->key
         << "\tValue: " << this->root->value << endl;

    if (this->left_subtree())
        this->left_subtree()->preorder_traversal();

    if (this->right_subtree())
        this->right_subtree()->preorder_traversal();
}

#endif /* BT_CPP */
