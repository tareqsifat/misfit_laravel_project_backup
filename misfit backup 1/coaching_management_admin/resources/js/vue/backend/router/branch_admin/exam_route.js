import Layout from '../../views/branch_admin/pages/exam/Layout'
import AllExam from '../../views/branch_admin/pages/exam/All'
import CreateExam from '../../views/branch_admin/pages/exam/Create'
import EditExam from '../../views/branch_admin/pages/exam/Edit'
import DetailsExam from '../../views/branch_admin/pages/exam/Details'
import AssingExamResult from '../../views/branch_admin/pages/exam/Result'
import ImportExam from '../../views/branch_admin/pages/exam/Import'

export default {
    path: 'exams',
    component: Layout,
    props: {
        role_permissions: ['branch_admin'],
        layout_title: 'Exam Management',
    },
    children: [
        {
            path: '',
            name: 'AllBranchExam',
            component: AllExam,
        },
        {
            path: 'import',
            name: 'ImportBranchExam',
            component: ImportExam,
        },
        {
            path: 'create',
            name: 'CreateBranchExam',
            component: CreateExam,
        },
        {
            path: 'edit/:id',
            name: 'EditBranchExam',
            component: EditExam,
        },
        {
            path: 'details/:id',
            name: 'DetailsBranchExam',
            component: DetailsExam,
        },
        {
            path: 'exam-result/:id',
            name: 'AssignBranchExamResult',
            component: AssingExamResult,
        },
    ],

};

