<?php

namespace App\Classes;

use App\Classes\Interfaces\CourseManagment;
use App\Config\Database;

class Course
{
    private ?int $id = null;
    private string $title;
    private string $description;
    private string $content;
    private int $categoryId;
    private string $creationDate;
    private int $teacherId;
    private array $tags = [];

    public function __construct(string $title, string $description, string $content, string $category, array $tags, int $teacherId, string $date = '', int $id = null)
    {
        $this->title = $title;
        $this->description = $description;
        $this->content = $content;
        $this->categoryId = $category;
        // $this->teacher = $teacher;
        $this->tags = $tags;
        $this->creationDate = $date;
        $this->teacherId = $teacherId;
        $this->id = $id;
    }


    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTeacherId(): ?int
    {
        return $this->teacherId;
    }

    public function getCreationDate(): string
    {
        return $this->creationDate;
    }

    public function setId($id)
    {
        $this->id = $id;
    }


    public function create(CourseManagment $courseCreator): bool
    {
        if ($this->id === null) {
            return $courseCreator->createCourse($this);
        }

        return false;
    }

    public function update(): bool
    {
        if ($this->id === null) {
            throw new \Exception("Id cannot be null for updating");
        }

        try {
            $data = [
                'title' => $this->getTitle(),
                'description' => $this->getDescription(),
                'content' => $this->getContent(),
                'categoryId' => $this->getCategoryId(),
                'teacherId' => $this->getTeacherId()
            ];

            $result = BaseModel::updateRecord('courses', $data, $this->id);

            if ($this->getTags()) {
                BaseModel::deleteRecord('courseTags', $this->id);
                foreach ($this->getTags() as $tag) {
                    if ($tag) {
                        BaseModel::insertRecord('courseTags', ['courseId' => $this->id, 'tagId' => $tag]);
                    }
                }
            }

            return $result;
        } catch (\Exception $e) {
            error_log("Error updating course: " . $e->getMessage());
            return false;
        }
    }

    public function delete(): bool
    {
        if ($this->id === null) {
            throw new \Exception("Id cannot be null for deleting");
        }

        try {
            return BaseModel::deleteRecord('courses', $this->id);
        } catch (\Exception $e) {
            error_log("Error deleting item: " . $e->getMessage());
            return false;
        }
    }

    public static function getCourseById(int $id): ?Course
    {
        $where = "id = ?";
        $result = BaseModel::selectRecords('courses', '*', $where, [$id]);

        if ($result) {

            $courseData = $result[0];

            $tags = BaseModel::selectRecords('courseTags', 'tagId', 'courseId = ?', [$id]);
            $tagIds = [];
            foreach ($tags as $tag) {
                $tagIds[] = $tag['tagId'];
            }

            return new Course($courseData['title'], $courseData['description'], $courseData['content'], $courseData['categoryId'], $tagIds, $courseData['teacherId'], $courseData['creationDate'], $courseData['id']);
        }

        return null;
    }

    public static function getAllCourses(): array
    {
        return BaseModel::selectRecords('courses');
    }

    public static function getCourseTags(int $courseid): array
    {
        $where = "courseId = ?";
        return BaseModel::selectRecords('coursetags', 'tagId', $where, [$courseid]) ?: [];
    }

    public static function getLimitCourses(int $limit, int $offset): array|bool
    {
        $query = "SELECT * FROM courses LIMIT :limit OFFSET :offset;";
        $stmt = (Database::connect())->prepare($query);
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
        if ($stmt->execute()) {
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result ?: [];
        }

        return false;
    }

    public static function getCountCourses(): array
    {
        return BaseModel::selectRecords('courses', 'COUNT(*) AS totalCourses');
    }

    public static function getTeacherCourses(int $teacherId): array|bool
    {
        try {
            $where = "teacherId = ?";

            $result = BaseModel::selectRecords('courses', '*', $where, [$teacherId]);

            return $result ?: [];
        } catch (\PDOException $e) {
            error_log("Error fetching teacher courses: " . $e->getMessage());
            return false;
        }
    }
}
