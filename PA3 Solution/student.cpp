/*
 * Student.cpp
 *
 */

#include "student.h"

/* TODO: Constructors
 * - history is a pointer to an int array, storing completed courses. 
 * - num is the length of this array.
 * When cp_type = AVL_CP, store course_plan as an AVL tree; otherwise store course_plan as a BST
 */
Student::Student(const string& id, const int* history, int num, CP_TYPE cp_type)
        : id(id)
{
    if (cp_type ==  AVL_CP)
        course_plan = new AVL<Course,int>;
    else 
        course_plan = new BST<Course,int>;

    for(int i = 0; i < num; i++)
        course_history.insert(history[i]);
}


/* TODO: Add a course into course_history
 *   course_db is a database containing all valid courses, stored in an STL map
 *   The key values used in the STL map are the course code
 */
void Student::update_course_history(const map<int, Course>& course_db, int code)
{
    // Make sure to check if the course code is valid
    if (course_db.find(code) != course_db.end())
        course_history.insert(code);
    else
        cout << id << ": Fail to update history with an invalid course COMP"
             << code << endl;
}

/* TODO:
 * Print completed courses in ascending order of the course codes
 */
void Student::print_course_history() const
{
    cout << id << ": Course history: ";

    set<int>::iterator it;
    for (it = course_history.begin(); it != course_history.end(); it++)
        cout << *it << " ";
    cout << endl;
}

/* TODO: Add a course into course_plan
 *   course_db is a database containing all valid courses, stored in an STL map
 *   The key values used in the STL map are the course code
 */
void Student::enroll(const map<int, Course>& course_db, int code)
{
    map<int, Course>::const_iterator mapit;
    bool insert = true;

    // Search course from the course database using course code
    mapit = course_db.find(code);

    // Check its pre-requisites
    if (mapit != course_db.end())
    {
        for (int i = 0; i < (mapit->second).get_num_prerequisites(); i++)
        {
            if (course_history.find((mapit->second).get_prerequisites(i))
                == course_history.end())
            {
                insert = false;
                break;
            }
        }
    }
    else
    {
        cout << id << ": Fail to enroll an invalid course COMP" << code << endl;
        return;
    }

    // Add the course into course_plan
    if (insert)
        course_plan->insert(mapit->second, code);
    else
        cout << id << ": Can't enroll COMP" << code
             << ". Not all pre-requisites are satisfied yet." << endl;
}

/* TODO:
 * Remove a course from course_plan
 */
void Student::drop(const int code)
{
    course_plan->remove(code);
}


/* TODO: Select courses with course_code larger than base from course_plan
 * Remark: Print the selected courses in ascending order of the course codes
 */
void Student::select_by_code(int base)
{
    cout << "Student ID: " << id << endl;

    course_plan->iterator_init();
    while (!course_plan->iterator_end())
    {
        Course& course = course_plan->iterator_next();
        if (course.get_code() > base)
            cout << course << endl;
    }
}

/* TODO: Select courses that have lectures on day from the course_plan
 * Remark: Print the selected courses in ascending order of the course codes
 */
void Student::select_by_day(weekday day)
{
    cout << "Student ID: " << id << endl;

    course_plan->iterator_init();
    while (!course_plan->iterator_end())
    {
        Course& course = course_plan->iterator_next();
        if (course.get_time().match(day))
            cout << course << endl;
    }
}

/* TODO: Check the details of an enrolled course
 * Remark: Print an appropriate message if the course is not in the course plan
 */
void Student::check_course(int code) const
{
    const BT<Course, int>* bt = course_plan->search(code);
    if (bt)
        bt->print_value();
    else
        cout << "No" << endl; 
}
    


/* TODO: Print all courses students plan to take 
 * Remark: Print the courses stored in the BT in preorder format
 */
void Student::list_course_plan() const
{
    cout << "Student ID: " << id << endl;
    course_plan->preorder_traversal();
}

/* Print course_plan in a readable tree format.
 * DON'T MODIFY THIS FUNCTION
 */
void Student::print_course_plan_tree() const
{
    cout << "Student ID: " << id << endl;
    course_plan->print();
}
